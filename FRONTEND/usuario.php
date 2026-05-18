<!DOCTYPE html>
<html lang="pt-br">
<body class="bg-[#E6DED3]">

    <?php include "UI/NAVBAR.php"; ?>

    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center border-b-4 border-[#A30F06]">
                    <div class="relative inline-block">
                        <img src="img/user-placeholder.png" alt="Foto do Usuário" class="w-32 h-32 rounded-full border-4 border-[#E6DED3] object-cover mx-auto">
                        <button class="absolute bottom-0 right-0 bg-[#A30F06] text-white p-2 rounded-full shadow-lg hover:bg-red-800 transition">
                            <i class="fas fa-camera text-xs"></i>
                        </button>
                    </div>
                    <h2 class="font-pagkaki text-2xl mt-4 text-gray-800">Pedro Lucas</h2>
                    <p class="text-sm text-gray-500 italic">Membro desde 2023</p>
                    
                    <nav class="mt-8 text-left space-y-2">
                        <a href="#" class="flex items-center space-x-3 p-3 bg-[#A30F06] text-white rounded-xl font-bold">
                            <i class="fas fa-user w-5"></i> <span>Meu Perfil</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-white hover:shadow-md rounded-xl transition">
                            <i class="fas fa-shopping-bag w-5"></i> <span>Meus Pedidos</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-white hover:shadow-md rounded-xl transition">
                            <i class="fas fa-map-marker-alt w-5"></i> <span>Endereços</span>
                        </a>
                        <hr class="my-4 border-gray-100">
                        <a href="deslogar.php" class="flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl transition">
                            <i class="fas fa-sign-out-alt w-5"></i> <span>Sair</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <main class="lg:col-span-3 space-y-8">
                
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-pagkaki text-3xl text-[#A30F06]">Dados Pessoais</h3>
                        <button class="text-sm font-bold text-blue-600 hover:underline">Editar Dados</button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Nome Completo</label>
                            <p class="text-lg font-medium border-b border-gray-100 py-2">Pedro Lucas</p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">E-mail</label>
                            <p class="text-lg font-medium border-b border-gray-100 py-2">pedro.lucas@email.com</p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Telefone</label>
                            <p class="text-lg font-medium border-b border-gray-100 py-2">(84) 99999-8888</p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">CPF</label>
                            <p class="text-lg font-medium border-b border-gray-100 py-2">000.000.000-00</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="bg-[#A30F06] p-4 text-white flex justify-between items-center">
                        <span class="font-bold uppercase text-xs tracking-tighter">Último Pedido: #88392</span>
                        <a href="#" class="text-xs underline opacity-80 hover:opacity-100 font-bold">Ver todos</a>
                    </div>
                    <div class="p-6 flex items-center space-x-6">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center p-2">
                            <img src="img/tenis.jpg" class="max-h-full object-contain">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800 uppercase">Tênis Basquete Kobe Mambacita</h4>
                            <p class="text-sm text-green-600 font-bold mt-1 uppercase"> <i class="fas fa-truck"></i> Em trânsito para Natal/RN</p>
                        </div>
                        <div class="text-right">
                            <span class="block font-pagkaki text-xl text-gray-800">R$ 1.299,99</span>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php include "UI/footer.php"; ?>

    <style>
        body {
            background: #E6DED3;
        }

        button[type="submit"] {
            background: #A30F06;
            color: white;
        }

        button[type="submit"]:hover {
            background: #800000;
        }
    </style>
</body>
</html>