<!DOCTYPE html>
<html lang="pt-br">
<body class="bg-[#E6DED3]">
 <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <?php include "../UI/NAVBAR.php"; ?>

    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b-4 border-[#A30F06] pb-4">
            <div>
                <h2 class="font-pagkaki text-5xl text-[#A30F06]">Meus Produtos</h2>
                <p class="text-gray-600 font-medium uppercase tracking-widest text-xs mt-2">Gerencie seu estoque e suas vendas no Shopin A</p>
            </div>
            <a href="cadastrar_produto.php" class="mt-4 md:mt-0 bg-[#A30F06] text-white px-6 py-3 rounded-xl font-bold hover:bg-red-800 transition flex items-center shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i> ADICIONAR NOVO PRODUTO
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-5 text-xs font-black text-gray-400 uppercase tracking-widest">Produto</th>
                        <th class="p-5 text-xs font-black text-gray-400 uppercase tracking-widest">Categoria</th>
                        <th class="p-5 text-xs font-black text-gray-400 uppercase tracking-widest">Preço</th>
                        <th class="p-5 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-5 flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg p-2 flex-shrink-0">
                                <img src="img/sela.webp" class="h-full w-full object-contain">
                            </div>
                            <div>
                                <span class="block font-bold text-gray-800 uppercase text-sm">Sela de Couro Legítimo Sertão</span>
                                <span class="text-[10px] text-gray-400">Cod: #00123</span>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="bg-[#E6DED3] text-[#A30F06] px-3 py-1 rounded-full text-[10px] font-black uppercase">Montaria</span>
                        </td>
                        <td class="p-5 font-pagkaki text-xl text-gray-700">
                            R$ 850,00
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center space-x-3">
                                <a href="#" class="text-blue-500 hover:text-blue-700 p-2 bg-blue-50 rounded-lg transition" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-lg transition" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-5 flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg p-2 flex-shrink-0">
                                <img src="img/mel.jpg" class="h-full w-full object-contain">
                            </div>
                            <div>
                                <span class="block font-bold text-gray-800 uppercase text-sm">Mel de Jandaíra Puro 250ml</span>
                                <span class="text-[10px] text-gray-400">Cod: #00456</span>
                            </div>
                        </td>
                        <td class="p-5">
                            <span class="bg-[#E6DED3] text-[#A30F06] px-3 py-1 rounded-full text-[10px] font-black uppercase">Alimentos</span>
                        </td>
                        <td class="p-5 font-pagkaki text-xl text-gray-700">
                            R$ 115,00
                        </td>
                        <td class="p-5">
                            <div class="flex justify-center space-x-3">
                                <a href="#" class="text-blue-500 hover:text-blue-700 p-2 bg-blue-50 rounded-lg transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-lg transition">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-500">
                <span class="text-xs font-black text-gray-400 uppercase">Produtos Ativos</span>
                <p class="text-3xl font-pagkaki mt-2">12</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500">
                <span class="text-xs font-black text-gray-400 uppercase">Vendas este mês</span>
                <p class="text-3xl font-pagkaki mt-2">24</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500">
                <span class="text-xs font-black text-gray-400 uppercase">Saldo a Receber</span>
                <p class="text-3xl font-pagkaki mt-2 text-green-600">R$ 2.450,00</p>
            </div>
        </div>
    </div>

    <?php include "../UI/FOOTER.php"; ?>

</body>
</html>