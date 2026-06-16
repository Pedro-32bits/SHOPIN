<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start();
require __DIR__ . "/../BACKEND/PDO/DAO/ProdutoDAO.php";
require __DIR__ . "/../BACKEND/PDO/DAO/FotoDAO.php";
require __DIR__ . "/../BACKEND/PDO/DAO/PossuiDAO.php"; // Incluído o DAO de associação

$cod = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
$produtoDao = new ProdutoDAO();
$fotoDao = new FotoDAO();
$possuiDao = new PossuiDAO();

$produto = $produtoDao->buscarPorId($cod);
$fotos = [];
if ($produto) {
    // Busca apenas as fotos do produto desta página
    $fotos = $fotoDao->buscarPorProduto($cod);
    if (!is_array($fotos)) $fotos = [];
}

$usuario_logado = isset($_SESSION['cod_usuario']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_resenha']) && $usuario_logado) {
    $avaliacao = isset($_POST['avaliacao']) ? intval($_POST['avaliacao']) : 5;
    $resenhaTexto = isset($_POST['resenha']) ? trim($_POST['resenha']) : '';
    $cod_usuario = $_SESSION['cod_usuario'];

   
    $pedidoExistente = $possuiDao->buscarPedidoDoUsuarioProduto($cod_usuario, $cod);

    if ($pedidoExistente) {
        $possuiDao->salvarResenha($pedidoExistente['cod_pedido'], $cod, $avaliacao, $resenhaTexto);
        header("Location: produto.php?cod=" . $cod . "&sucesso=1#secao-resenhas");
        exit;
    } else {
        // Se não encontrar o pedido (regrade negócio padrão: só comenta quem comprou)
        header("Location: produto.php?cod=" . $cod . "&erro_compra=1#secao-resenhas");
        exit;
    }
}

// Buscar todas as resenhas ativas do produto para exibir na página
$resenhas = $possuiDao->buscarPorProduto($cod);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome'] ?? 'Produto'); ?> - SHOPIN A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Pagkaki';
            src: url('fonts/Pagkaki-Regular.otf') format('opentype');
            font-display: swap;
        }
        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }
    </style>
</head>
<body class="bg-[#E6DED3]">

    <?php include "UI/NAVBAR.php"; ?>

    <main class="container mx-auto px-4 py-12">
        <?php if (!$produto): ?>
            <div class="bg-white rounded-lg p-8 text-center">Produto não encontrado.</div>
        <?php else: ?>
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12">
            
            <div class="w-full lg:w-1/2 flex flex-col items-center">
                <div class="relative w-full bg-white rounded-2xl shadow-xl p-8 flex items-center justify-center min-h-[400px]">
                    <?php if (!empty($fotos)): ?>
                        <img id="fotoPrincipal" src="<?php echo htmlspecialchars($fotos[0]['foto']); ?>" alt="Produto Principal" class="max-h-[350px] w-auto object-contain">
                    <?php else: ?>
                        <img id="fotoPrincipal" src="img/placeholder.php" alt="Produto Principal" class="max-h-[350px] w-auto object-contain" onerror="this.style.display='none'">
                    <?php endif; ?>
                </div>

                <div class="flex mt-6 gap-4 w-full justify-center">
                    <?php foreach ($fotos as $i => $ft): ?>
                        <div class="w-24 h-20 bg-white rounded-lg p-2 border-b-4 <?php echo $i === 0 ? 'border-[#A30F06]' : 'border-transparent'; ?> cursor-pointer shadow-md hover:border-[#A30F06] transition-all"
                             onclick="trocarFoto('<?php echo htmlspecialchars($ft['foto']); ?>', this)">
                            <img src="<?php echo htmlspecialchars($ft['foto']); ?>" class="w-full h-full object-cover rounded">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center py-6">
                <h1 class="font-pagkaki text-4xl md:text-6xl text-[#A30F06] leading-none mb-4">
                    <?php echo htmlspecialchars($produto['nome']); ?>
                </h1>

                <div class="flex items-center gap-6 mb-8">
                    <?php if (!empty($produto['promocao']) && $produto['promocao'] > 0): ?>
                        <span class="font-pagkaki text-3xl text-[#A30F06]">R$<?php echo number_format($produto['promocao'],2,',','.'); ?></span>
                        <span class="text-xl text-gray-400 line-through font-bold">R$<?php echo number_format($produto['valor'],2,',','.'); ?></span>
                    <?php else: ?>
                        <span class="font-pagkaki text-3xl text-[#A30F06]">R$<?php echo number_format($produto['valor'],2,',','.'); ?></span>
                    <?php endif; ?>
                </div>

                <div class="space-y-6">
                    <p class="text-gray-600 text-lg leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($produto['descricao'])); ?>
                    </p>
                    <p class="text-sm text-gray-500">Categoria: <?php echo htmlspecialchars($produto['categoria_nome'] ?? 'Sem categoria'); ?></p>
                    <p class="text-sm text-gray-500">Vendedor: <?php echo htmlspecialchars($produto['vendedor_nome'] ?? 'Anônimo'); ?></p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="button" onclick="comprarAgora()" class="bg-[#A30F06] text-white font-pagkaki text-lg px-8 py-3 rounded-2xl shadow-lg hover:bg-red-800 transition-all">
                            COMPRAR AGORA
                        </button>
                        <button type="button" onclick="adicionarAoCarrinho()" class="border-2 border-[#A30F06] text-[#A30F06] font-bold px-6 py-3 rounded-2xl hover:bg-[#A30F06] hover:text-white transition-all">
                            <i class="fas fa-cart-plus mr-2"></i> ADICIONAR AO CARRINHO
                        </button>
                    </div>

                    <p class="text-[#A30F06] font-bold text-sm uppercase tracking-widest mt-4">
                        <i class="fas fa-truck-moving mr-2"></i> Frete Acelerado de Rápido para todo o Nordeste
                    </p>
                </div>
            </div>

        </div>

        <div id="secao-resenhas" class="mt-16 bg-white rounded-2xl shadow-xl p-6 md:p-8">
            <h2 class="font-pagkaki text-2xl md:text-3xl text-[#A30F06] mb-6 border-b pb-4">
                <i class="fas fa-comments mr-2"></i> Avaliações e Resenhas
            </h2>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    Sua resenha foi publicada com sucesso! Obrigado pela contribuição.
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['erro_compra'])): ?>
                <div class="bg-amber-100 border border-amber-400 text-amber-700 px-4 py-3 rounded-xl mb-6">
                    Apenas clientes que já adquiriram este produto podem deixar uma resenha.
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 lg:border-r lg:pr-8 border-gray-200">
                    <?php if ($usuario_logado): ?>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Deixe sua avaliação</h3>
                        <form method="POST" action="" class="space-y-4">
                            <input type="hidden" name="enviar_resenha" value="1">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sua Nota:</label>
                                <select name="avaliacao" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-2.5 focus:ring-[#A30F06] focus:border-[#A30F06]" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5 - Excelente)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 - Muito Bom)</option>
                                    <option value="3">⭐⭐⭐ (3 - Regular)</option>
                                    <option value="2">⭐⭐ (2 - Ruim)</option>
                                    <option value="1">⭐ (1 - Péssimo)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sua Resenha:</label>
                                <textarea name="resenha" rows="4" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 focus:ring-[#A30F06] focus:border-[#A30F06] placeholder-gray-400 text-sm" placeholder="O que você achou do produto? Detalhe sua experiência..." required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#A30F06] text-white font-bold py-2.5 px-4 rounded-xl hover:bg-red-800 transition-all shadow-md">
                                Enviar Comentário
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="bg-gray-50 rounded-xl p-6 text-center text-gray-600 border border-dashed border-gray-300">
                            <p class="text-sm mb-3">Deseja deixar uma resenha sobre o produto?</p>
                            <a href="cliente/userLogin.php" class="inline-block bg-[#A30F06] text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-red-800 transition-all">
                                Fazer Login
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="lg:col-span-2 space-y-4 max-h-[500px] overflow-y-auto pr-2">
                    <?php if (empty($resenhas)): ?>
                        <div class="text-gray-500 italic text-center py-12">
                            <i class="far <i class="far fa-comment-dots text-3xl mb-2 block"></i>
                            Nenhuma resenha feita para este produto ainda.
                        </div>
                    <?php else: ?>
                        <?php foreach ($resenhas as $res): ?>
                            <div class="bg-gray-50 p-4 rounded-xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-800 text-sm">
                                        <?php echo htmlspecialchars($res['usuario_nome'] ?? 'Comprador'); ?>
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        <?php echo date('d/m/Y', strtotime($res['data_avaliacao'])); ?>
                                    </span>
                                </div>
                                
                                <div class="text-amber-500 text-xs mb-2">
                                    <?php 
                                        $nota = intval($res['avaliacao'] ?? 5);
                                        echo str_repeat('★', $nota) . str_repeat('☆', 5 - $nota); 
                                    ?>
                                </div>
                                
                                <p class="text-gray-600 text-sm whitespace-pre-line leading-relaxed">
                                    <?php echo htmlspecialchars($res['resenha']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <?php include "UI/footer.php"; ?>

    <form id="carrinhoForm" method="POST" action="../BACKEND/PDO/gerenciar_carrinho.php" style="display: none;">
        <input type="hidden" name="acao" value="">
        <input type="hidden" name="cod_produto" value="<?php echo $cod; ?>">
        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
        <input type="hidden" name="marca" value="<?php echo htmlspecialchars($produto['marca'] ?? ''); ?>">
        <input type="hidden" name="preco" value="<?php echo !empty($produto['promocao']) && $produto['promocao'] > 0 ? $produto['promocao'] : ($produto['valor'] ?? 0); ?>">
        <input type="hidden" name="foto" value="<?php echo htmlspecialchars($fotos[0]['foto'] ?? 'img/placeholder.php'); ?>">
        <input type="hidden" name="quantidade" value="1">
    </form>

    <script>
        function trocarFoto(src, thumb) {
            document.getElementById('fotoPrincipal').src = src;
            // Remove destaque de todos os thumbs e coloca no clicado
            document.querySelectorAll('[onclick^="trocarFoto"]').forEach(el => {
                el.classList.remove('border-[#A30F06]');
                el.classList.add('border-transparent');
            });
            thumb.classList.remove('border-transparent');
            thumb.classList.add('border-[#A30F06]');
        }

        function adicionarAoCarrinho(redirecionarPagamento = false) {
            <?php if (!$usuario_logado): ?>
                if (confirm('Você precisa estar logado para adicionar produtos ao carrinho. Deseja fazer login agora?')) {
                    window.location.href = 'cliente/userLogin.php';
                }
            <?php else: ?>
                const formData = new FormData(document.getElementById('carrinhoForm'));
                formData.append('acao', 'adicionar');

                fetch('../BACKEND/PDO/gerenciar_carrinho.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        if (redirecionarPagamento) {
                            window.location.href = 'pagamento.php';
                        } else {
                            alert(data.mensagem);
                            location.reload(); // Recarregar para atualizar contador do carrinho
                        }
                    } else {
                        alert('Erro ao adicionar ao carrinho!');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao processar a requisição!');
                });
            <?php endif; ?>
        }

        function comprarAgora() {
            <?php if (!$usuario_logado): ?>
                if (confirm('Você precisa estar logado para comprar. Deseja fazer login agora?')) {
                    window.location.href = 'cliente/userLogin.php';
                }
            <?php else: ?>
                adicionarAoCarrinho(true);
            <?php endif; ?>
        }
    </script>

</body>

</html>