<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors' , 1);
ob_start();
require __DIR__ . "/../BACKEND/PDO/DAO/ProdutoDAO.php";
require __DIR__ . "/../BACKEND/PDO/DAO/FotoDAO.php";

$cod = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
$produtoDao = new ProdutoDAO();
$fotoDao = new FotoDAO();
$produto = $produtoDao->buscarPorId($cod);
$fotos = [];
if ($produto) {
    // Busca apenas as fotos do produto desta página
    $fotos = $fotoDao->buscarPorProduto($cod);
    if (!is_array($fotos)) $fotos = [];
}

// Verificar se usuário está logado
$usuario_logado = isset($_SESSION['cod_usuario']);
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
        <?php endif; ?>
    </main>

    <?php include "UI/FOOTER.php"; ?>

    <!-- Formulário hidden para adicionar ao carrinho -->
    <form id="carrinhoForm" method="POST" action="../BACKEND/PDO/gerenciar_carrinho.php" style="display: none;">
        <input type="hidden" name="acao" value="">
        <input type="hidden" name="cod_produto" value="<?php echo $cod; ?>">
        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
        <input type="hidden" name="marca" value="<?php echo htmlspecialchars($produto['marca'] ?? ''); ?>">
        <input type="hidden" name="preco" value="<?php echo $produto['promocao'] > 0 ? $produto['promocao'] : $produto['valor']; ?>">
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

        function adicionarAoCarrinho() {
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
                        alert(data.mensagem);
                        location.reload(); // Recarregar para atualizar contador do carrinho
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
                adicionarAoCarrinho();
                setTimeout(() => {
                    window.location.href = 'cliente/usuario.php';
                }, 500);
            <?php endif; ?>
        }
    </script>

</body>
<?php echo ob_get_clean(); ?>
</html>