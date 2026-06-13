<?php

session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo']  !== 'vendedor') {
    header("Location: loginVend.php");
    exit();
}

require __DIR__ . "/../../BACKEND/PDO/DAO/ProdutoDAO.php";
require __DIR__ . "/../../BACKEND/PDO/DAO/CategoriaDAO.php";

$produtoDao = new ProdutoDAO();
$categoriaDao = new CategoriaDAO();
$categorias = $categoriaDao->listar();
$produtos = $produtoDao->listarPorVendedor($_SESSION['cod_usuario']);
$totalProdutos = count($produtos);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SHOPIN A - Painel do Vendedor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-[#E6DED3] min-h-screen">



    <div class="container mx-auto px-4 py-10">

        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b-4 border-[#A30F06] pb-4">

            <div>
                <h2 class="text-5xl text-[#A30F06] font-black uppercase">
                    Meus Produtos
                </h2>

                <p class="text-gray-600 font-medium uppercase tracking-widest text-xs mt-2">
                    Gerencie seus produtos na SHOPIN A
                </p>
            </div>

            <button
                onclick="abrirModalInserir()" class="mt-4 md:mt-0 bg-[#A30F06] text-white px-6 py-4 rounded-2xl font-bold hover:bg-[#7d0b04] transition flex items-center shadow-xl cursor-pointer"> <i class="fas fa-plus-circle mr-3"></i> ADICIONAR PRODUTO
            </button>

        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-[#A30F06] text-white">

                    <tr>
                        <th class="p-5 text-left uppercase text-xs tracking-widest">
                            Produto
                        </th>

                        <th class="p-5 text-left uppercase text-xs tracking-widest">
                            Categoria
                        </th>

                        <th class="p-5 text-left uppercase text-xs tracking-widest">
                            Preço
                        </th>

                        <th class="p-5 text-center uppercase text-xs tracking-widest">
                            Ações
                        </th>
                    </tr>

                </thead>

                <tbody>
                    <?php if (!empty($produtos)): ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr class="border-b border-gray-100 hover:bg-[#f5efe8] transition">
                                <td class="p-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-[#E6DED3] rounded-2xl overflow-hidden">
                                            <img
                                                src="<?php echo !empty($produto['foto']) ? '../' . htmlspecialchars($produto['foto']) : '../img/placeholder.php'; ?>"
                                                class="w-full h-full object-cover" onerror="this.src='../img/placeholder.php'">
                                        </div>

                                        <div>
                                            <h3 class="font-bold text-[#A30F06] uppercase">
                                                <?php echo htmlspecialchars($produto['nome']); ?>
                                            </h3>

                                            <span class="text-xs text-gray-400">
                                                Código #<?php echo htmlspecialchars($produto['cod_produto']); ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-5">
                                    <span class="bg-[#E6DED3] text-[#A30F06] px-4 py-2 rounded-full text-xs font-black uppercase">
                                        <?php echo htmlspecialchars(!empty($produto['categoria_nome']) ? $produto['categoria_nome'] : 'Sem categoria'); ?>
                                    </span>
                                </td>

                                <td class="p-5 font-black text-xl text-gray-700">
                                    R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?>
                                </td>

                                <td class="p-5">
                                    <div class="flex justify-center gap-3">
                                        
                                        <button type="button" 
                                                onclick="abrirModalEditar(this)"
                                                data-cod="<?php echo $produto['cod_produto']; ?>"
                                                data-nome="<?php echo htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-marca="<?php echo htmlspecialchars($produto['marca'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-estoque="<?php echo $produto['estoque']; ?>"
                                                
                                                data-descricao="<?php echo htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-valor="<?php echo $produto['valor']; ?>"
                                                data-promocao="<?php echo $produto['promocao']; ?>"
                                                data-categoria="<?php echo $produto['cod_categoria']; ?>"
                                                class="bg-blue-100 text-blue-600 w-11 h-11 rounded-xl hover:scale-105 transition flex items-center justify-center cursor-pointer" 
                                                title="Editar Produto">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="../../BACKEND/PDO/CONTROLLER/ProdutoController.php" method="POST" class="inline m-0" onsubmit="return confirm('Tem certeza absoluta que deseja apagar este produto?');">
                                            <input type="hidden" name="acao" value="Apagar">
                                            <input type="hidden" name="cod_produto" value="<?php echo $produto['cod_produto']; ?>">
                                            
                                            <button type="submit" class="bg-red-100 text-red-600 w-11 h-11 rounded-xl hover:scale-105 transition flex items-center justify-center cursor-pointer" title="Excluir Produto">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="p-5 text-center text-gray-500">
                                Você ainda não cadastrou produtos.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

            <div class="bg-white rounded-3xl p-6 shadow-xl border-l-[6px] border-yellow-500">

                <span class="text-xs font-black text-gray-400 uppercase">
                    Produtos Ativos
                </span>

                <h2 class="text-4xl font-black text-[#A30F06] mt-3">
                    <?php echo $totalProdutos; ?>
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border-l-[6px] border-green-500">

                <span class="text-xs font-black text-gray-400 uppercase">
                    Vendas do Mês
                </span>

                <h2 class="text-4xl font-black text-[#A30F06] mt-3">
                    24
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border-l-[6px] border-blue-500">

                <span class="text-xs font-black text-gray-400 uppercase">
                    Saldo
                </span>

                <h2 class="text-4xl font-black text-green-600 mt-3">
                    R$ 2.450
                </h2>

            </div>

        </div>

    </div>

    <div id="modalProduto" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div class="bg-[#E6DED3] w-full max-w-lg rounded-[28px] shadow-2xl overflow-hidden animate-modal overflow-y-auto" style="max-height: calc(100vh - 4rem);">

            <div class="bg-[#A30F06] px-6 py-5 flex items-center justify-between">

                <div>
                    <h2 id="modal_titulo" class="text-xl font-black text-white uppercase">
                        Novo Produto
                    </h2>

                    <p class="text-red-100 text-xs mt-1">
                        Preencha os dados do produto
                    </p>
                </div>

                <button onclick="fecharModal()" class="text-white text-2xl cursor-pointer">
                    ✕
                </button>

            </div>

            <form action="../../BACKEND/PDO/CONTROLLER/ProdutoController.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">

                <input type="hidden" name="acao" id="modal_acao" value="Inserir">
                <input type="hidden" name="cod_produto" id="modal_cod_produto" value="">

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Nome</label>
                    <input type="text" name="nome" id="modal_nome" required placeholder="Nome do produto" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Marca</label>
                    <input type="text" name="marca" id="modal_marca" placeholder="Marca do produto" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Estoque</label>
                    <input type="number" name="estoque" id="modal_estoque" required placeholder="Quantidade em estoque" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Descrição</label>
                    <textarea name="descricao" id="modal_descricao" rows="3" placeholder="Descrição do produto" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none resize-none focus:border-[#A30F06]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Valor</label>
                    <input type="number" step="0.01" name="valor" id="modal_valor" required placeholder="R$ 0,00" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Promoção</label>
                    <input type="number" step="0.01" name="promocao" id="modal_promocao" placeholder="Preço promocional" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">Categoria</label>
                    <select name="cod_categoria" id="modal_categoria" required class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                        <option value="">Selecione a categoria</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo htmlspecialchars($categoria['cod_categoria']); ?>">
                                <?php echo htmlspecialchars($categoria['cod_categoria'] . ' - ' . $categoria['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-3"> 📸 Adicionar Fotos do Produto </label>

                    <div id="uploadArea" class="border-3 dashed border-[#A30F06] rounded-2xl p-8 text-center cursor-pointer bg-gradient-to-b from-white to-[#fef5f0] transition hover:bg-[#fff5f0]" ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" onclick="document.getElementById('photoInput').click()">
                        <div class="text-4xl mb-2">🖼️</div>
                        <p class="text-[#A30F06] font-bold">Clique para escolher ou arraste fotos</p>
                        <p class="text-gray-500 text-sm mt-1">PNG, JPG</p>
                    </div>

                    <input type="file" id="photoInput" name="fotos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelect(event)">

                    <div id="photoPreview" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mt-4"></div>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-2">

                    <button type="button" onclick="fecharModal()" class="border-2 border-[#A30F06] text-[#A30F06] py-3 rounded-2xl font-black hover:bg-[#A30F06] hover:text-white transition cursor-pointer">
                        Cancelar
                    </button>

                    <button type="submit" class="bg-[#A30F06] text-white py-3 rounded-2xl font-black hover:bg-[#7d0b04] transition cursor-pointer">
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

    <?php include "../UI/FOOTER.php"; ?>

    <script>
        let selectedFiles = [];

        // --- NOVAS FUNÇÕES PARA O MODAL ---
        
        function abrirModalInserir() {
            document.getElementById('modal_titulo').innerText = "Novo Produto";
            document.getElementById('modal_acao').value = "Inserir";
            document.getElementById('modal_cod_produto').value = "";
            
            // Limpa todos os campos
            document.getElementById('modal_nome').value = "";
            document.getElementById('modal_marca').value = "";
            document.getElementById('modal_estoque').value = "";
            document.getElementById('modal_descricao').value = "";
            document.getElementById('modal_valor').value = "";
            document.getElementById('modal_promocao').value = "";
            document.getElementById('modal_categoria').value = "";

            document.getElementById('modalProduto').classList.remove('hidden');
        }

        function abrirModalEditar(botao) {
            document.getElementById('modal_titulo').innerText = "Editar Produto";
            document.getElementById('modal_acao').value = "atualizar"; 
            
            // Puxa os dados dos atributos data-* do botão
            document.getElementById('modal_cod_produto').value = botao.getAttribute('data-cod');
            document.getElementById('modal_nome').value = botao.getAttribute('data-nome');
            document.getElementById('modal_marca').value = botao.getAttribute('data-marca');
            document.getElementById('modal_estoque').value = botao.getAttribute('data-estoque');
            document.getElementById('modal_descricao').value = botao.getAttribute('data-descricao');
            document.getElementById('modal_valor').value = botao.getAttribute('data-valor');
            document.getElementById('modal_promocao').value = botao.getAttribute('data-promocao');
            document.getElementById('modal_categoria').value = botao.getAttribute('data-categoria');

            document.getElementById('modalProduto').classList.remove('hidden');
        }

        function fecharModal() {
            document.getElementById('modalProduto').classList.add('hidden');
            selectedFiles = [];
            document.getElementById('photoPreview').innerHTML = '';
            document.getElementById('photoInput').value = '';
        }

        // --- FUNÇÕES DE UPLOAD DE FOTOS MANTIDAS ---

        function handleDragOver(e) {
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('uploadArea').classList.add('bg-[#fff5f0]', 'border-yellow-500', 'scale-105');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            document.getElementById('uploadArea').classList.remove('bg-[#fff5f0]', 'border-yellow-500', 'scale-105');
        }

        function handleDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('uploadArea').classList.remove('bg-[#fff5f0]', 'border-yellow-500', 'scale-105');
            handleFiles(e.dataTransfer.files);
        }

        function handleFileSelect(e) {
            if (!e.target.files.length) return;
            handleFiles(e.target.files);
        }

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const duplicado = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                if (!duplicado) selectedFiles.push(file);
            });
            syncInputEPreview();
        }

        function syncInputEPreview() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            document.getElementById('photoInput').files = dataTransfer.files;
            updatePhotoPreview();
        }

        function updatePhotoPreview() {
            const preview = document.getElementById('photoPreview');
            preview.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'relative bg-white rounded-xl overflow-hidden shadow-md';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover">
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-700 transition cursor-pointer" onclick="removerFoto(${index})">×</button>
                        <p class="text-xs p-1 text-gray-600 truncate">${file.name}</p>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        function removerFoto(index) {
            selectedFiles.splice(index, 1);
            syncInputEPreview();
        }
    </script>

    <style>
        @keyframes modal {

            from {
                opacity: 0;
                transform: scale(.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }

        }

        .animate-modal {
            animation: modal .25s ease;
        }
    </style>

</body>

</html>