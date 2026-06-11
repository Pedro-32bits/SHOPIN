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
            --dark-red: #800c05;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-bege);
            color: #333;
        }

        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }

        .font-cordel {
            font-family: 'Metamorphous', serif;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <?php include "UI/NAVBAR.php"; ?>

    <main class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row items-start gap-12">
            
            <div class="w-full lg:w-3/5 bg-white rounded-2xl shadow-xl p-8 md:p-10 border-b-4 border-[#A30F06]">
                <h2 class="font-pagkaki text-5xl text-[#A30F06] mb-8 uppercase leading-tight">Forma de Pagamento</h2>
                
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <button type="button" class="flex flex-col items-center justify-center p-4 border-2 border-[#A30F06] bg-red-50/50 rounded-xl text-[#A30F06] font-bold transition">
                        <i class="fas fa-credit-card text-2xl mb-2"></i>
                        <span class="text-xs uppercase tracking-wider">Cartão</span>
                    </button>
                    <button type="button" class="flex flex-col items-center justify-center p-4 border-2 border-[#E6DED3] hover:border-[#A30F06] rounded-xl text-gray-500 hover:text-[#A30F06] bg-fafafa transition">
                        <i class="fab fa-pix text-2xl mb-2"></i>
                        <span class="text-xs uppercase tracking-wider">Pix</span>
                    </button>
                    <button type="button" class="flex flex-col items-center justify-center p-4 border-2 border-[#E6DED3] hover:border-[#A30F06] rounded-xl text-gray-500 hover:text-[#A30F06] bg-fafafa transition">
                        <i class="fas fa-barcode text-2xl mb-2"></i>
                        <span class="text-xs uppercase tracking-wider">Boleto</span>
                    </button>
                </div>

                <form action="processar_pagamento.php" method="POST" class="space-y-5">
                    <div>
                        <label class="w-full text-left font-bold block text-xs color-[#666] uppercase tracking-[0.5px]">Número do Cartão</label>
                        <div class="w-full padding-[0_15px] border-2 border-[#E6DED3] rounded-[10px] bg-[#fafafa] flex items-center p-3 gap-3 focus-within:border-[#A30F06] focus-within:bg-white transition-all">
                            <i class="fas fa-credit-card text-[#A30F06]"></i>
                            <input type="text" placeholder="0000 0000 0000 0000" class="w-full border-none outline-none bg-transparent text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="w-full text-left font-bold block text-xs color-[#666] uppercase tracking-[0.5px]">Nome do Titular (Como no cartão)</label>
                        <input type="text" placeholder="JOÃO D S SAURO" class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] font-size-[14px] focus:border-[#A30F06] focus:bg-white transition-all uppercase">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="w-full text-left font-bold block text-xs color-[#666] uppercase tracking-[0.5px]">Validade</label>
                            <input type="text" placeholder="MM/AA" class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] font-size-[14px] focus:border-[#A30F06] focus:bg-white transition-all text-center">
                        </div>
                        <div>
                            <label class="w-full text-left font-bold block text-xs color-[#666] uppercase tracking-[0.5px]">CVV / Cód. Segurança</label>
                            <div class="w-full border-2 border-[#E6DED3] rounded-[10px] bg-[#fafafa] flex items-center p-3 gap-3 focus-within:border-[#A30F06] focus-within:bg-white transition-all">
                                <input type="password" maxlength="4" placeholder="***" class="w-full border-none outline-none bg-transparent text-sm text-center">
                                <i class="fas fa-question-circle text-gray-400 cursor-pointer"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="w-full text-left font-bold block text-xs color-[#666] uppercase tracking-[0.5px]">Parcelamento</label>
                        <select class="w-full p-3 border-2 border-[#E6DED3] rounded-[10px] outline-none bg-[#fafafa] font-size-[14px] focus:border-[#A30F06] focus:bg-white transition-all font-semibold text-gray-700">
                            <option value="1">1x de R$ 2.680,00 sem juros</option>
                            <option value="5">5x de R$ 536,00 sem juros</option>
                            <option value="12">12x de R$ 223,33 sem juros</option>
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full p-4 rounded-[10px] font-bold text-sm text-white uppercase tracking-[0.5px] shadow-lg bg-gradient-to-r from-[#A30F06] to-[#7d0b04] hover:from-[#8a0d05] hover:to-[#650a03] hover:shadow-[0_6px_20px_rgba(163,15,6,0.3)] hover:-translate-y-0.5 active:scale-[0.98] transition-all">
                            <i class="fas fa-lock mr-2"></i> Confirmar e Pagar Agora
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full lg:w-2/5 flex flex-col justify-center">
                <h1 class="font-pagkaki text-6xl md:text-7xl text-[#A30F06] leading-tight mb-6 uppercase">
                    Resumo do <br> Seu Pedido
                </h1>

                <div class="bg-white/40 p-6 rounded-2xl border-2 border-[#A30F06]/20 space-y-4">
                    <div class="flex items-center gap-4 border-b border-gray-300 pb-4">
                        <div class="w-20 h-20 bg-white rounded-xl p-2 flex items-center justify-center shadow-sm">
                            <img src="img/tv_sam.webp" alt="Produto" class="max-h-full object-contain">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800 text-sm uppercase leading-tight">TV Smart Samsung 60"</h4>
                            <p class="text-xs text-gray-500 font-semibold mt-1">Quantidade: 1</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <span class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Total a pagar:</span>
                        <div class="flex items-baseline gap-4">
                            <span class="font-pagkaki text-5xl md:text-6xl text-[#A30F06]">R$2680,00</span>
                        </div>
                        <p class="text-sm font-bold text-green-700 mt-2">
                            <i class="fas fa-tags mr-1"></i> Cupom de desconto aplicado com sucesso!
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3 text-gray-600 px-2">
                    <i class="fas fa-shield-alt text-2xl text-[#A30F06]"></i>
                    <p class="text-xs font-medium leading-relaxed">
                        Ambiente totalmente criptografado e seguro. Seus dados de pagamento não ficam salvos em nossos servidores sertanejos.
                    </p>
                </div>
            </div>

        </div>
    </main>

    <?php include "UI/FOOTER.php"; ?>

</body>
</html>