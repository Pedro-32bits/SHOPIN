
<?php
if (!isset($_SESSION)) {
    session_start();
}

$usuario_logado = isset($_SESSION['cod_usuario']);
$nome_cliente = $_SESSION['nome'] ?? '';
$foto_cliente = $_SESSION['foto'] ?? '';
$qtd_carrinho = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
?>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
            <a href="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? '../index.php' : 'index.php'; ?>"><img src="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? '../' : ''; ?>img/logo.png" class="h-14 w-auto object-contain" alt="Logo"></a>
            <h1 class="text-white text-4xl font-pagkaki whitespace-nowrap mt-4">SHOPIN A</h1>
        </div>

        <div class="flex-1 flex justify-center px-4">
            <div class="relative w-full max-w-2xl">
                <form action="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? '../pesquisa.php' : 'pesquisa.php'; ?>" method="GET" class="w-full">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="pesquisa" placeholder="Buscar no SHOPIN A..." 
                        class="search-bar w-full py-3 pl-12 pr-4 focus:outline-none text-gray-800 font-medium bg-white border border-gray-300">
                </form>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-6 text-white w-1/4">
            <?php if ($usuario_logado): ?>
                <div class="flex items-center space-x-2 cursor-pointer hover:opacity-80 transition" title="<?php echo htmlspecialchars($nome_cliente); ?>">
                    <img src="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? '../' : ''; ?><?php echo !empty($foto_cliente) ? $foto_cliente : 'img/user-placeholder.php'; ?>" class="w-8 h-8 rounded-full object-cover" onerror="this.src='<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? '../' : ''; ?>img/placeholder.php'">
                    <a href="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? 'usuario.php' : 'cliente/usuario.php'; ?>" class="text-sm font-medium truncate max-w-[100px]">
                        <?php echo explode(' ', htmlspecialchars($nome_cliente))[0]; ?>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? 'userLogin.php' : 'cliente/userLogin.php'; ?>" class="hover:opacity-80 transition">
                    <i class="fas fa-user-circle text-2xl"></i>
                </a>
            <?php endif; ?>
            
            <a href="<?php echo strpos($_SERVER['PHP_SELF'], 'cliente') !== false ? 'usuario.php#carrinho' : 'cliente/usuario.php#carrinho'; ?>" class="hover:opacity-80 relative transition">
                <i class="fas fa-shopping-basket text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-white text-shopin-red text-[10px] font-black px-1.5 rounded-full">
                    <?php echo $qtd_carrinho; ?>
                </span>
            </a>
        </div>
    </div>
</header>