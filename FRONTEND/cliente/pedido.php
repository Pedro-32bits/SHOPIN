<?php
session_start();

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: userLogin.php");
    exit();
}

require_once __DIR__ . "/../../BACKEND/PDO/DAO/PedidoDAO.php";

$codPedido = $_GET['cod'] ?? '';
$pedidoDao = new PedidoDAO();
$pedido = $codPedido ? $pedidoDao->buscarDetalhadoPorUsuario($codPedido, $_SESSION['cod_usuario']) : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido - SHOPIN A</title>
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

    <main class="container mx-auto px-4 py-10">
        <?php if (!$pedido): ?>
            <div class="bg-white rounded-2xl shadow-sm p-10 text-center">
                <i class="fas fa-receipt text-gray-300 text-6xl mb-4"></i>
                <h1 class="font-pagkaki text-4xl text-[#A30F06] mb-2">Pedido nao encontrado</h1>
                <a href="usuario.php#pedidos" class="inline-block mt-4 bg-[#A30F06] text-white px-6 py-3 rounded-xl font-bold">Voltar aos pedidos</a>
            </div>
        <?php else: ?>
            <?php if (isset($_GET['sucesso'])): ?>
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 rounded-xl p-4 font-bold">
                    Pagamento simulado aprovado. Pedido criado com sucesso!
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-2xl shadow-sm p-8 border-b-4 border-[#A30F06]">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-8">
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Pedido</p>
                        <h1 class="font-pagkaki text-5xl text-[#A30F06]"><?php echo htmlspecialchars($pedido['cod_pedido']); ?></h1>
                        <p class="text-gray-500 font-semibold mt-2">
                            Forma de pagamento: <?php echo htmlspecialchars($pedido['formaPag'] ?? 'Pagamento simulado'); ?>
                        </p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total</p>
                        <p class="font-pagkaki text-5xl text-[#A30F06]">R$ <?php echo number_format((float) $pedido['preco'], 2, ',', '.'); ?></p>
                        <span class="inline-block mt-2 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-black uppercase">Pago</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <?php foreach ($pedido['itens'] as $item): ?>
                        <?php
                        $preco = (!empty($item['promocao']) && $item['promocao'] > 0) ? (float) $item['promocao'] : (float) $item['valor'];
                        $subtotal = $preco * (int) $item['qnt'];
                        ?>
                        <div class="flex items-center gap-4 border border-gray-200 rounded-xl p-4">
                            <img src="../<?php echo htmlspecialchars($item['foto'] ?? 'img/placeholder.php'); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" class="w-20 h-20 object-cover rounded-xl bg-[#E6DED3]" onerror="this.src='../img/placeholder.php'">
                            <div class="flex-1">
                                <h2 class="font-bold text-[#A30F06] uppercase"><?php echo htmlspecialchars($item['nome']); ?></h2>
                                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($item['marca'] ?? ''); ?></p>
                                <p class="text-xs text-gray-500">Vendedor: <?php echo htmlspecialchars($item['vendedor_nome'] ?? 'Nao informado'); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-500">Qtd: <?php echo (int) $item['qnt']; ?></p>
                                <p class="font-black text-gray-800">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php include "../UI/footer.php"; ?>
</body>
</html>
