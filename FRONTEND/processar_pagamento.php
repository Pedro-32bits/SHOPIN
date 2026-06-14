<?php
session_start();

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: cliente/userLogin.php");
    exit();
}

$carrinho = $_SESSION['carrinho'] ?? [];
if (empty($carrinho)) {
    header("Location: cliente/usuario.php#carrinho");
    exit();
}

require __DIR__ . "/../BACKEND/PDO/conexao.php";

$formaPag = $_POST['formaPag'] ?? 'Cartao';
$codUsuario = (int) $_SESSION['cod_usuario'];
$codPedido = 'PED' . date('YmdHis') . random_int(100, 999);

try {
    $conexao->beginTransaction();

    $produtos = [];
    $total = 0;

    $buscarProduto = $conexao->prepare("SELECT cod_produto, valor, promocao FROM produto WHERE cod_produto = :cod_produto");
    foreach ($carrinho as $item) {
        $codProduto = (int) ($item['cod_produto'] ?? 0);
        $quantidade = max(1, (int) ($item['quantidade'] ?? 1));

        $buscarProduto->execute([":cod_produto" => $codProduto]);
        $produto = $buscarProduto->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            throw new Exception("Produto indisponivel.");
        }

        $preco = (!empty($produto['promocao']) && $produto['promocao'] > 0)
            ? (float) $produto['promocao']
            : (float) $produto['valor'];

        $produtos[] = [
            'cod_produto' => $codProduto,
            'quantidade' => $quantidade,
            'preco' => $preco
        ];
        $total += $preco * $quantidade;
    }

    $inserirPedido = $conexao->prepare(
        "INSERT INTO pedido (cod_pedido, cod_usuario, formaPag, preco, cupom, validacao, notaF)
         VALUES (:cod_pedido, :cod_usuario, :formaPag, :preco, :cupom, :validacao, :notaF)"
    );
    $inserirPedido->execute([
        ":cod_pedido" => $codPedido,
        ":cod_usuario" => $codUsuario,
        ":formaPag" => $formaPag,
        ":preco" => $total,
        ":cupom" => null,
        ":validacao" => 1,
        ":notaF" => 'NF-' . $codPedido
    ]);

    $inserirItem = $conexao->prepare(
        "INSERT INTO possui (cod_pedido, cod_produto, qnt, avaliacao, resenha)
         VALUES (:cod_pedido, :cod_produto, :qnt, :avaliacao, :resenha)"
    );
    $somarVendidos = $conexao->prepare(
        "UPDATE produto SET vendidos = COALESCE(vendidos, 0) + :qnt WHERE cod_produto = :cod_produto"
    );

    foreach ($produtos as $produto) {
        $inserirItem->execute([
            ":cod_pedido" => $codPedido,
            ":cod_produto" => $produto['cod_produto'],
            ":qnt" => $produto['quantidade'],
            ":avaliacao" => null,
            ":resenha" => null
        ]);

        $somarVendidos->execute([
            ":qnt" => $produto['quantidade'],
            ":cod_produto" => $produto['cod_produto']
        ]);
    }

    $conexao->commit();
    $_SESSION['carrinho'] = [];

    header("Location: cliente/pedido.php?cod=" . urlencode($codPedido) . "&sucesso=1");
    exit();
} catch (Exception $e) {
    if ($conexao->inTransaction()) {
        $conexao->rollBack();
    }

    header("Location: pagamento.php?erro=1");
    exit();
}
