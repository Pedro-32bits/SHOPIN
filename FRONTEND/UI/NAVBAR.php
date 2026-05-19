
<?php include "gatinhos.js" ?>
<style>
    /* Estilos customizados para bater com o design */
    .header-gradient {
        background: linear-gradient(90deg, #A30F06 0%, #A30F06 100%);
    }
    .search-bar {
        border-radius: 2px;
    }
    .font-pagkaki {
        font-family: 'Arial Black', sans-serif; /* Ajuste para a fonte do seu logo */
    }
    .text-shopin-red {
        color: #a3250c;
    }
</style>

<header class="header-gradient p-4 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between">
        
        <div class="flex items-center space-x-3 w-1/4">
            <img src="..\img\logo.png" class="h-14 w-auto object-contain" alt="Logo">
            <h1 class="text-white text-4xl font-pagkaki whitespace-nowrap mt-4">SHOPIN A</h1>
        </div>

        <div class="flex-1 flex justify-center px-4">
            <div class="relative w-full max-w-2xl">
                <form action="pesquisa.php" method="GET" class="w-full">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="pesquisa" placeholder="Buscar no SHOPIN A..." 
                        class="search-bar w-full py-3 pl-12 pr-4 focus:outline-none text-gray-800 font-medium">
                </form>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-6 text-white w-1/4">
            <a href="/shopin/FRONTEND/usuario.php" class="hover:opacity-80">
                <i class="fas fa-user-circle text-2xl"></i>
            </a>
            
            <button class="hover:opacity-80 relative">
                <i class="fas fa-shopping-basket text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-white text-shopin-red text-[10px] font-black px-1.5 rounded-full">
                    0
                </span>
            </button>
        </div>
    </div>
</header>