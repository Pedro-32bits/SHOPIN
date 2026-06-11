<?php 
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cod_usuario'])) {
    header("Location: userLogin.php");
    exit();
}

// Variáveis da sessão
$cod_usuario = $_SESSION['cod_usuario'];
$nome = $_SESSION['nome'] ?? '';
$email = $_SESSION['email'] ?? '';
$telefone = $_SESSION['telefone'] ?? '';
$cpf = $_SESSION['cpf'] ?? '';
$carrinho = $_SESSION['carrinho'] ?? array();

$msg = "";
if (isset($_GET['sucesso']) && $_GET['sucesso'] == "1") {
    $msg = '<div style="color: green; background: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px;">Dados atualizados com sucesso!</div>';
}
if (isset($_GET['erro'])) {
    $msg = '<div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px;">Erro ao atualizar dados!</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - SHOPIN A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Pagkaki';
            src: url('../fonts/Pagkaki-Regular.otf') format('opentype');
            font-display: swap;
        }
        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }
    </style>
</head>
<body class="bg-[#E6DED3]">

    <?php include "../UI/NAVBAR.php"; ?>

    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- SIDEBAR -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center border-b-4 border-[#A30F06]">
                    <div class="flex justify-center mb-4">
                        <div class="w-32 h-32 rounded-full bg-[#E6DED3] border-4 border-[#E6DED3] flex items-center justify-center">
                            <i class="fas fa-user text-[#A30F06] text-5xl"></i>
                        </div>
                    </div>
                    
                    <h2 class="font-pagkaki text-2xl mt-4 text-gray-800"><?php echo htmlspecialchars($nome); ?></h2>
                    <p class="text-sm text-gray-500 italic">Cliente</p>
                    
                    <nav class="mt-8 text-left space-y-2">
                        <a href="#perfil" class="flex items-center space-x-3 p-3 bg-[#A30F06] text-white rounded-xl font-bold">
                            <i class="fas fa-user w-5"></i> <span>Meu Perfil</span>
                        </a>
                        <a href="#pedidos" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-white hover:shadow-md rounded-xl transition">
                            <i class="fas fa-shopping-bag w-5"></i> <span>Meus Pedidos</span>
                        </a>
                        <a href="#carrinho" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-white hover:shadow-md rounded-xl transition">
                            <i class="fas fa-shopping-cart w-5"></i> <span>Carrinho (<?php echo count($carrinho); ?>)</span>
                        </a>
                        <a href="#endereco" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-white hover:shadow-md rounded-xl transition">
                            <i class="fas fa-map-marker-alt w-5"></i> <span>Endereços</span>
                        </a>
                        <hr class="my-4 border-gray-100">
                        <a href="deslogar.php" class="flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl transition">
                            <i class="fas fa-sign-out-alt w-5"></i> <span>Sair</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- CONTEÚDO PRINCIPAL -->
            <main class="lg:col-span-3 space-y-8">
                
                <?php echo $msg; ?>
                
                <!-- DADOS PESSOAIS -->
                <div id="perfil" class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-pagkaki text-3xl text-[#A30F06]">Dados Pessoais</h3>
                        <button class="text-sm font-bold text-blue-600 hover:underline" onclick="editarPerfil()">Editar Dados</button>
                    </div>
                    
                    <!-- MODO VISUALIZAÇÃO -->
                    <div id="view-perfil">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Nome Completo</label>
                                <p class="text-lg font-medium border-b border-gray-100 py-2"><?php echo htmlspecialchars($nome); ?></p>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">E-mail</label>
                                <p class="text-lg font-medium border-b border-gray-100 py-2"><?php echo htmlspecialchars($email); ?></p>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Telefone</label>
                                <p class="text-lg font-medium border-b border-gray-100 py-2"><?php echo htmlspecialchars($telefone); ?></p>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">cpf</label>
                                <p class="text-lg font-medium border-b border-gray-100 py-2"><?php echo htmlspecialchars($cpf); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- MODO EDIÇÃO -->
                    <div id="edit-perfil" style="display: none;">
                        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/UsuarioController.php">
                            <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
                            <input type="hidden" name="acao" value="atualizar">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nome Completo</label>
                                    <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">E-mail</label>
                                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Telefone</label>
                                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">cpf</label>
                                    <input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Senha</label>
                                    <input type="password" name="senha" placeholder="Deixe em branco para manter a anterior" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" class="bg-[#A30F06] text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700">Salvar Alterações</button>
                                <button type="button" onclick="cancelarEdicao()" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-400">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- CARRINHO -->
                <div id="carrinho" class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-pagkaki text-3xl text-[#A30F06]">Meu Carrinho</h3>
                        <span class="text-sm font-bold text-gray-600"><?php echo count($carrinho); ?> item(ns)</span>
                    </div>
                    
                    <?php if (empty($carrinho)): ?>
                        <div class="text-center py-12">
                            <i class="fas fa-shopping-cart text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 font-medium">Seu carrinho está vazio</p>
                            <a href="../index.php" class="mt-4 inline-block bg-[#A30F06] text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700">Continuar Comprando</a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php 
                            $total = 0;
                            foreach ($carrinho as $item): 
                                $subtotal = $item['preco'] * $item['quantidade'];
                                $total += $subtotal;
                            ?>
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg" data-produto-id="<?php echo $item['cod_produto']; ?>">
                                    <img src="<?php echo $item['foto']; ?>" alt="<?php echo $item['nome']; ?>" class="w-20 h-20 object-cover rounded">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800"><?php echo htmlspecialchars($item['nome']); ?></h4>
                                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($item['marca']); ?></p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <button class="bg-gray-200 px-2 py-1 rounded" onclick="alterarQuantidade(<?php echo $item['cod_produto']; ?>, -1)">-</button>
                                            <span><?php echo $item['quantidade']; ?></span>
                                            <button class="bg-gray-200 px-2 py-1 rounded" onclick="alterarQuantidade(<?php echo $item['cod_produto']; ?>, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-lg">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                                        <button class="text-red-500 text-sm hover:text-red-700" onclick="removerDoCarrinho(<?php echo $item['cod_produto']; ?>)">Remover</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-lg font-bold">Total:</span>
                                <span class="font-pagkaki text-2xl text-[#A30F06]">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                            </div>
                            <button class="w-full bg-[#A30F06] text-white py-3 rounded-lg font-bold hover:bg-red-700">Prosseguir para Pagamento</button>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ENDEREÇOS -->
                <div id="endereco" class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-pagkaki text-3xl text-[#A30F06]">Meus Endereços</h3>
                        <button class="text-sm font-bold text-blue-600 hover:underline">+ Adicionar Endereço</button>
                    </div>
                    <div class="text-center py-12">
                        <i class="fas fa-map-marker-alt text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500 font-medium">Nenhum endereço cadastrado</p>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php include "../UI/footer.php"; ?>

    <style>
        .auth-input-group {
            position: relative;
        }
        .auth-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

    <script>
        function editarPerfil() {
            document.getElementById('view-perfil').style.display = 'none';
            document.getElementById('edit-perfil').style.display = 'block';
        }

        function cancelarEdicao() {
            document.getElementById('view-perfil').style.display = 'block';
            document.getElementById('edit-perfil').style.display = 'none';
        }

        function alterarQuantidade(codProduto, delta) {
            const carrinhoItems = document.querySelectorAll('[data-produto-id="' + codProduto + '"]');
            if (carrinhoItems.length > 0) {
                const spanQtd = carrinhoItems[0].querySelector('span');
                const quantidadeAtual = parseInt(spanQtd.textContent);
                const novaQuantidade = quantidadeAtual + delta;

                if (novaQuantidade <= 0) {
                    removerDoCarrinho(codProduto);
                    return;
                }

                const formData = new FormData();
                formData.append('acao', 'atualizar_quantidade');
                formData.append('cod_produto', codProduto);
                formData.append('quantidade', novaQuantidade);

                fetch('../../BACKEND/PDO/gerenciar_carrinho.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        location.reload();
                    } else {
                        alert('Erro ao atualizar quantidade!');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao processar a requisição!');
                });
            }
        }

        function removerDoCarrinho(codProduto) {
            if (confirm('Deseja remover este produto do carrinho?')) {
                const formData = new FormData();
                formData.append('acao', 'remover');
                formData.append('cod_produto', codProduto);

                fetch('../../BACKEND/PDO/gerenciar_carrinho.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        location.reload();
                    } else {
                        alert('Erro ao remover produto!');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao processar a requisição!');
                });
            }
        }

        function limparCarrinho() {
            if (confirm('Deseja limpar todo o carrinho?')) {
                const formData = new FormData();
                formData.append('acao', 'limpar');

                fetch('../../BACKEND/PDO/gerenciar_carrinho.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {
                        location.reload();
                    } else {
                        alert('Erro ao limpar carrinho!');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao processar a requisição!');
                });
            }
        }
    </script>

</body>
</html>