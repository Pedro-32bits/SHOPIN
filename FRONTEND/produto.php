<!DOCTYPE html>
<html lang="pt-br">
<body class="bg-[#E6DED3]">

    <?php include "UI/NAVBAR.php"; ?>

    <main class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12">
            
            <div class="w-full lg:w-1/2 flex flex-col items-center">
                <div class="relative w-full bg-white rounded-2xl shadow-xl p-8 flex items-center justify-center min-h-[400px]">
                    <button class="absolute left-4 text-[#A30F06] text-4xl hover:scale-110 transition">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <img src="img/tv_sam.webp" alt="Produto Principal" class="max-h-[350px] w-auto object-contain">
                    
                    <button class="absolute right-4 text-[#A30F06] text-4xl hover:scale-110 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="flex mt-6 gap-4 w-full justify-center">
                    <div class="w-24 h-20 bg-white rounded-lg p-2 border-b-4 border-[#A30F06] cursor-pointer shadow-md">
                        <img src="img/tv_sam_1.jpg" class="w-full h-full object-cover">
                    </div>
                    <div class="w-24 h-20 bg-white rounded-lg p-2 opacity-60 hover:opacity-100 cursor-pointer shadow-md transition">
                        <img src="img/tv_sam_2.jpg" class="w-full h-full object-cover">
                    </div>
                    <div class="w-24 h-20 bg-white rounded-lg p-2 opacity-60 hover:opacity-100 cursor-pointer shadow-md transition">
                        <img src="img/tv_sam_3.jpg" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center py-6">
                <h1 class="font-pagkaki text-6xl md:text-8xl text-[#A30F06] leading-none mb-8">
                    TV SMART SAMSUNG <br> 60 POLEGADAS
                </h1>

                <div class="flex items-center gap-6 mb-8">
                    <span class="font-pagkaki text-5xl text-[#A30F06]">R$2680,00</span>
                    <span class="text-2xl text-gray-400 line-through font-bold">R$3350,00</span>
                    <span class="bg-[#A30F06] text-white px-3 py-1 rounded-md font-black text-xl">-20%</span>
                </div>

                <div class="space-y-6">
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Experiência ultra nítida com resolução 4K. Design Slim, processador Crystal 4K e Alexa integrada para o melhor do entretenimento no seu sertão.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button class="bg-[#A30F06] text-white font-pagkaki text-2xl px-12 py-5 rounded-2xl shadow-lg hover:bg-red-800 transition-all hover:-translate-y-1">
                            COMPRAR AGORA
                        </button>
                        <button class="border-2 border-[#A30F06] text-[#A30F06] font-bold px-8 py-5 rounded-2xl hover:bg-[#A30F06] hover:text-white transition-all">
                            <i class="fas fa-cart-plus mr-2"></i> ADICIONAR AO CARRINHO
                        </button>
                    </div>

                    <p class="text-[#A30F06] font-bold text-sm uppercase tracking-widest mt-4">
                        <i class="fas fa-truck-moving mr-2"></i> Frete Arretado de Rápido para todo o Nordeste
                    </p>
                </div>
            </div>

        </div>
    </main>

    <?php include "UI/FOOTER.php"; ?>

</body>
</html>