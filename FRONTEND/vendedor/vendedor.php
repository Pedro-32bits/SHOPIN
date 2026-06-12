<?php

session_start();
if (empty($_SESSION['tipo']) || $_SESSION['tipo'] !== 'vendedor') {
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-[#E6DED3] min-h-screen">

    <?php include "../UI/NAVBAR.php"; ?>

    <!-- CONTAINER -->
    <div class="container mx-auto px-4 py-10">

        <!-- TOPO -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b-4 border-[#A30F06] pb-4">

            <div>
                <h2 class="text-5xl text-[#A30F06] font-black uppercase">
                    Meus Produtos
                </h2>

                <p class="text-gray-600 font-medium uppercase tracking-widest text-xs mt-2">
                    Gerencie seus produtos na SHOPIN A
                </p>
            </div>

            <!-- BOTÃO -->
            <button
                onclick="abrirModal()" class="mt-4 md:mt-0 bg-[#A30F06] text-white px-6 py-4 rounded-2xl font-bold hover:bg-[#7d0b04] transition flex items-center shadow-xl"> <i class="fas fa-plus-circle mr-3"></i> ADICIONAR PRODUTO
            </button>

        </div>

        <!-- TABELA -->
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
                                        <button class="bg-blue-100 text-blue-600 w-11 h-11 rounded-xl hover:scale-105 transition" >
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="bg-red-100 text-red-600 w-11 h-11 rounded-xl hover:scale-105 transition" >
                                            <i class="fas fa-trash"></i>
                                        </button>
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

        <!-- CARDS -->
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

    <!-- MODAL -->
    <div
        id="modalProduto"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <!-- CARD -->
        <div class="bg-[#E6DED3] w-full max-w-lg rounded-[28px] shadow-2xl overflow-hidden animate-modal overflow-y-auto" style="max-height: calc(100vh - 4rem);">

            <!-- TOPO -->
            <div class="bg-[#A30F06] px-6 py-5 flex items-center justify-between">

                <div>
                    <h2 class="text-xl font-black text-white uppercase">
                        Novo Produto
                    </h2>

                    <p class="text-red-100 text-xs mt-1">
                        Cadastre rapidamente
                    </p>
                </div>

                <!-- FECHAR -->
                <button
                    onclick="fecharModal()"
                    class="text-white text-2xl">
                    ✕
                </button>

            </div>

            <!-- FORM -->
            <form
                action="../../BACKEND/PDO/CONTROLLER/ProdutoController.php"
                method="POST"
                enctype="multipart/form-data"
                class="p-6 space-y-4">

                <input type="hidden" name="acao" value="Inserir">

                <!-- NOME -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Nome
                    </label>

                    <input
                        type="text"
                        name="nome"
                        required
                        placeholder="Nome do produto"
                        class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">

                </div>

                <!-- MARCA -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Marca
                    </label>

                    <input
                        type="text"
                        name="marca"
                        required
                        placeholder="Marca do produto"
                        class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">

                </div>

                <!-- ESTOQUE -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Estoque
                    </label>

                    <input
                        type="number"
                        name="estoque"
                        required
                        placeholder="Quantidade em estoque"
                        class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">

                </div>

                <!-- DESCRIÇÃO -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        rows="3"
                        placeholder="Descrição do produto"
                        class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none resize-none focus:border-[#A30F06]"></textarea>

                </div>

                <!-- VALOR -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Valor
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="valor"
                        required
                        placeholder="R$ 0,00"
                        class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">

                </div>

                <!-- PROMOÇÃO -->
                <div>

                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Promoção
                    </label>

                    <input type="number" step="0.01" name="promocao" placeholder="Preço promocional" class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                </div>

                <!-- CATEGORIA -->
                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-2">
                        Categoria
                    </label>
                    <select name="cod_categoria" required class="w-full bg-white border-2 border-[#d8c8b8] rounded-2xl px-4 py-3 outline-none focus:border-[#A30F06]">
                        <option value="">Selecione a categoria</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo htmlspecialchars($categoria['cod_categoria']); ?>">
                                <?php echo htmlspecialchars($categoria['cod_categoria'] . ' - ' . $categoria['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- FOTO -->
                <div>
                    <label class="block text-xs font-black uppercase text-[#A30F06] mb-3"> 📸 Adicionar Fotos do Produto </label>

                    <!-- Área de Upload -->
                    <div id="uploadArea" class="border-3 dashed border-[#A30F06] rounded-2xl p-8 text-center cursor-pointer bg-gradient-to-b from-white to-[#fef5f0] transition hover:bg-[#fff5f0]" ondrop="handleDrop(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" onclick="document.getElementById('photoInput').click()">
                        <div class="text-4xl mb-2">🖼️</div>
                        <p class="text-[#A30F06] font-bold">Clique para escolher ou arraste fotos</p>
                        <p class="text-gray-500 text-sm mt-1">PNG, JPG</p>
                    </div>

                    <input type="file" id="photoInput" name="fotos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelect(event)">

                    <!-- Preview de Fotos -->
                    <div id="photoPreview" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mt-4"></div>
                </div>

                <!-- BOTÕES -->
                <div class="grid grid-cols-2 gap-3 pt-2">

                    <button type="button" onclick="fecharModal()" class="border-2 border-[#A30F06] text-[#A30F06] py-3 rounded-2xl font-black hover:bg-[#A30F06] hover:text-white transition">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="bg-[#A30F06] text-white py-3 rounded-2xl font-black hover:bg-[#7d0b04] transition">
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

    <?php include "../UI/FOOTER.php"; ?>

    <!-- SCRIPT -->
    <script>
        let selectedFiles = [];

        function abrirModal() {
            document.getElementById('modalProduto').classList.remove('hidden');
        }

        function fecharModal() {
            document.getElementById('modalProduto').classList.add('hidden');
            selectedFiles = [];
            document.getElementById('photoPreview').innerHTML = '';
            document.getElementById('photoInput').value = '';
        }

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
            // ACUMULA os arquivos novos em vez de substituir os anteriores
            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                // Evita duplicatas pelo nome+tamanho
                const duplicado = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                if (!duplicado) selectedFiles.push(file);
            });
            syncInputEPreview();
        }

        function syncInputEPreview() {
            // Sincroniza o input file com o array selectedFiles
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
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-700 transition" onclick="removerFoto(${index})">×</button>
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

    <!-- ANIMAÇÃO -->
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