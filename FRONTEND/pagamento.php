<?php
session_start();

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: cliente/userLogin.php");
    exit();
}

$carrinho = $_SESSION['carrinho'] ?? [];
if (empty($carrinho)) {
    header("Location: cliente/usuario.php#carrinho");
    exit();
}

$total = 0;
foreach ($carrinho as $item) {
    $total += ((float) $item['preco']) * ((int) $item['quantidade']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPIN A | Finalizar Pagamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metamorphous&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Pagkaki';
            src: url('../fonts/Pagkaki-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        :root {
            --bg-bege: #E6DED3;
            --shopin-red: #A30F06;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-bege);
            color: #333;
        }
        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }
    </style>
</head>
<body>
    <?php include "UI/NAVBAR.php"; ?>

    <main class="container mx-auto px-4 py-12">
        <?php if (isset($_GET['erro'])): ?>
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 font-bold">
                Nao foi possivel finalizar o pagamento simulado. Tente novamente.
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row items-start gap-12">
            <div class="w-full lg:w-3/5 bg-white rounded-2xl shadow-xl p-8 md:p-10 border-b-4 border-[#A30F06]">
                <h2 class="font-pagkaki text-5xl text-[#A30F06] mb-8 uppercase leading-tight">Forma de Pagamento</h2>

                <form action="processar_pagamento.php" method="POST" class="space-y-5">
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <label class="flex flex-col items-center justify-center p-4 border-2 border-[#A30F06] bg-red-50/50 rounded-xl text-[#A30F06] font-bold transition cursor-pointer">
                            <input type="radio" name="formaPag" value="Cartao" checked class="sr-only">
                            <i class="fas fa-credit-card text-2xl mb-2"></i>
                            <span class="text-xs uppercase tracking-wider">Cartao</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border-2 border-[#E6DED3] hover:border-[#A30F06] rounded-xl text-gray-500 hover:text-[#A30F06] bg-[#fafafa] transition cursor-pointer">
                            <input type="radio" name="formaPag" value="Pix" class="sr-only">
                            <i class="fab fa-pix text-2xl mb-2"></i>
                            <span class="text-xs uppercase tracking-wider">Pix</span>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 border-2 border-[#E6DED3] hover:border-[#A30F06] rounded-xl text-gray-500 hover:text-[#A30F06] bg-[#fafafa] transition cursor-pointer">
                            <input type="radio" name="formaPag" value="Boleto" class="sr-only">
                            <i class="fas fa-barcode text-2xl mb-2"></i>
                            <span class="text-xs uppercase tracking-wider">Boleto</span>
                        </label>
                    </div>

                    <div>
                        <label class="w-full text-left font-bold block text-xs text-gray-500 uppercase tracking-[0.5px]">Numero do Cartao</label>
                        <div class="w-full border-2 border-[#E6DED3] rounded-[10px] bg-[#fafafa] flex items-center p-3 gap-3 focus-within:border-[#A30F06] focus-within:bg-white transition-all">
                            <i class="fas fa-credit-card text-[#A30F06]"></i>
                            <input type="text" placeholder="0000 0000 0000 0000" class="w-full border-none outline-none bg-transparent text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="w-full text-left font-bold block text-xs text-gray-500 uppercase tracking-[0.5px]">Nome do Titular</label>
                        <input type="text" placeholder="CLIENTE SHOPIN" class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] text-sm focus:border-[#A30F06] focus:bg-white transition-all uppercase">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="w-full text-left font-bold block text-xs text-gray-500 uppercase tracking-[0.5px]">Validade</label>
                            <input type="text" placeholder="MM/AA" class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] text-sm focus:border-[#A30F06] focus:bg-white transition-all text-center">
                        </div>
                        <div>
                            <label class="w-full text-left font-bold block text-xs text-gray-500 uppercase tracking-[0.5px]">CVV</label>
                            <input type="password" maxlength="4" placeholder="***" class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] text-sm focus:border-[#A30F06] focus:bg-white transition-all text-center">
                        </div>
                    </div>

                    <div>
                        <label class="w-full text-left font-bold block text-xs text-gray-500 uppercase tracking-[0.5px]">Parcelamento</label>
                        <select class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] text-sm focus:border-[#A30F06] focus:bg-white transition-all font-semibold text-gray-700">
                            <option value="1">1x de R$ <?php echo number_format($total, 2, ',', '.'); ?> sem juros</option>
                            <option value="2">2x de R$ <?php echo number_format($total / 2, 2, ',', '.'); ?> sem juros</option>
                            <option value="5">5x de R$ <?php echo number_format($total / 5, 2, ',', '.'); ?> sem juros</option>
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full p-4 rounded-[10px] font-bold text-sm text-white uppercase tracking-[0.5px] shadow-lg bg-gradient-to-r from-[#A30F06] to-[#7d0b04] hover:from-[#8a0d05] hover:to-[#650a03] hover:shadow-[0_6px_20px_rgba(163,15,6,0.3)] hover:-translate-y-0.5 active:scale-[0.98] transition-all">
                            <i class="fas fa-lock mr-2"></i> Confirmar pagamento simulado
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full lg:w-2/5 flex flex-col justify-center">
                <h1 class="font-pagkaki text-6xl md:text-7xl text-[#A30F06] leading-tight mb-6 uppercase">
                    Resumo do <br> Seu Pedido
                </h1>

                <div class="bg-white/40 p-6 rounded-2xl border-2 border-[#A30F06]/20 space-y-4">
                    <?php foreach ($carrinho as $item): ?>
                        <?php $subtotal = ((float) $item['preco']) * ((int) $item['quantidade']); ?>
                        <div class="flex items-center gap-4 border-b border-gray-300 pb-4">
                            <div class="w-20 h-20 bg-white rounded-xl p-2 flex items-center justify-center shadow-sm">
                                <img src="<?php echo htmlspecialchars($item['foto'] ?? 'img/placeholder.php'); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" class="max-h-full object-contain">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 text-sm uppercase leading-tight"><?php echo htmlspecialchars($item['nome']); ?></h4>
                                <p class="text-xs text-gray-500 font-semibold mt-1">Quantidade: <?php echo (int) $item['quantidade']; ?></p>
                                <p class="text-sm font-black text-[#A30F06] mt-1">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="pt-2">
                        <span class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Total a pagar:</span>
                        <span class="font-pagkaki text-5xl md:text-6xl text-[#A30F06]">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                        <p class="text-sm font-bold text-green-700 mt-2">
                            <i class="fas fa-check-circle mr-1"></i> Pagamento simulado para MVP.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3 text-gray-600 px-2">
                    <i class="fas fa-shield-alt text-2xl text-[#A30F06]"></i>
                    <p class="text-xs font-medium leading-relaxed">
                        Nenhum dado de pagamento real sera cobrado ou armazenado nesta versao.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include "UI/footer.php"; ?>
</body>
</html>
