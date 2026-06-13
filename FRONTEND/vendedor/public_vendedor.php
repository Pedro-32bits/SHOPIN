<?php
require __DIR__ . "/../../BACKEND/PDO/DAO/UsuarioDAO.php";
require __DIR__ . "/../../BACKEND/PDO/DAO/ProdutoDAO.php";

$cod = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
$vDao = new usuarioDAO();
$pDao = new ProdutoDAO();

$usuario  = null;
$produtos = [];
if ($cod) {
    // buscar usuario  simples via listar e filtrar
    $lista = $vDao->listar();
    foreach ($lista as $v) {
        if (isset($v['cod_usuario']) && $v['cod_usuario'] == $cod) {
            $usuario  = $v;
            break;
        }
        if (!isset($v['cod_usuario']) && isset($v['cod']) && $v['cod'] == $cod) {
            // fallback caso a linha ainda use 'cod' como chave
            $usuario  = $v;
            break;
        }
    }
    $produtos = $pDao->listarPorUsuario ($cod);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Usuario </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#E6DED3]">
    <?php include __DIR__ . "/../UI/NAVBAR.php"; ?>
    <main class="container mx-auto p-6">
        <?php if (!$usuario ): ?>
            <div class="bg-white p-6 rounded">Usuario  não encontrado.</div>
        <?php else: ?>
            <div class="bg-white p-6 rounded mb-6">
                <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($usuario ['nome']); ?></h2>
                <p><?php echo htmlspecialchars($usuario ['email']); ?></p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php foreach ($produtos as $p): ?>
                    <?php $foto = !empty($p['foto']) ? $p['foto'] : '../img/placeholder.php'; ?>
                    <a href="../produto.php?cod=<?php echo $p['cod_produto']; ?>" class="block bg-white p-3 rounded shadow">
                        <img src="<?php echo htmlspecialchars($foto); ?>" class="w-full h-40 object-contain mb-2" onerror="this.src='../img/placeholder.php'">
                        <div class="font-bold text-sm"><?php echo htmlspecialchars($p['nome']); ?></div>
                        <div class="text-xs text-gray-600">R$<?php echo number_format($p['valor'],2,',','.'); ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
