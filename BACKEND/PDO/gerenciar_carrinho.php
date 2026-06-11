<?php
// arquivo: BACKEND/PDO/gerenciar_carrinho.php
// Este arquivo gerencia o carrinho em sessão

if (!isset($_SESSION)) {
    session_start();
}

// Inicializar carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";

// Adicionar ao carrinho
if ($acao == "adicionar") {
    $cod_produto = isset($_POST['cod_produto']) ? (int)$_POST['cod_produto'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $marca = isset($_POST['marca']) ? $_POST['marca'] : "";
    $preco = isset($_POST['preco']) ? (float)$_POST['preco'] : 0;
    $foto = isset($_POST['foto']) ? $_POST['foto'] : "";
    $quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 1;
    
    if ($cod_produto > 0 && $preco > 0) {
        // Verificar se o produto já está no carrinho
        $encontrado = false;
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['cod_produto'] == $cod_produto) {
                $item['quantidade'] += $quantidade;
                $encontrado = true;
                break;
            }
        }
        
        // Se não encontrou, adicionar novo item
        if (!$encontrado) {
            $_SESSION['carrinho'][] = array(
                'cod_produto' => $cod_produto,
                'nome' => $nome,
                'marca' => $marca,
                'preco' => $preco,
                'foto' => $foto,
                'quantidade' => $quantidade
            );
        }
        
        // Responder com JSON (para AJAX)
        header('Content-Type: application/json');
        echo json_encode(['sucesso' => true, 'mensagem' => 'Produto adicionado ao carrinho!']);
        exit;
    }
}

// Remover do carrinho
if ($acao == "remover") {
    $cod_produto = isset($_POST['cod_produto']) ? (int)$_POST['cod_produto'] : 0;
    
    foreach ($_SESSION['carrinho'] as $key => $item) {
        if ($item['cod_produto'] == $cod_produto) {
            unset($_SESSION['carrinho'][$key]);
            break;
        }
    }
    
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    
    header('Content-Type: application/json');
    echo json_encode(['sucesso' => true, 'mensagem' => 'Produto removido do carrinho!']);
    exit;
}

// Atualizar quantidade
if ($acao == "atualizar_quantidade") {
    $cod_produto = isset($_POST['cod_produto']) ? (int)$_POST['cod_produto'] : 0;
    $quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 1;
    
    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['cod_produto'] == $cod_produto) {
            if ($quantidade > 0) {
                $item['quantidade'] = $quantidade;
            } else {
                // Se quantidade é 0 ou negativa, remover o item
                unset($item);
            }
            break;
        }
    }
    
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    
    header('Content-Type: application/json');
    echo json_encode(['sucesso' => true, 'mensagem' => 'Quantidade atualizada!']);
    exit;
}

// Limpar carrinho
if ($acao == "limpar") {
    $_SESSION['carrinho'] = array();
    
    header('Content-Type: application/json');
    echo json_encode(['sucesso' => true, 'mensagem' => 'Carrinho limpo!']);
    exit;
}

?>
