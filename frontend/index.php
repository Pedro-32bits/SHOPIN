<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPIN A | O Marketplace do Nordeste</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metamorphous&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        /* 4. Importação da Fonte Local Pagkaki */
        @font-face {
            font-family: 'Pagkaki';
            /* Certifique-se que o arquivo está na pasta fonts na raiz do projeto */
            src: url('fonts/Pagkaki-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        /* 5. Variáveis de Cores do Projeto */
        :root {
            --bg-bege: #E6DED3;
            --shopin-red: #A30F06;
            --shopin-terracota: #A30F06;
            --dark-red: #800c05;
        }

        /* 6. Estilos Globais */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-bege);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Classes de Fontes Customizadas */
        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }

        .font-cordel {
            font-family: 'Metamorphous', serif;
            text-transform: uppercase;
        }

        /* Utilitários de Componentes */
        .header-gradient {
            background-color: var(--shopin-red);
        }

        .promo-banner {
            background-color: var(--shopin-terracota);
            border-radius: 2rem;
            color: white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-banner {
            background-color: white;
            color: var(--shopin-terracota);
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: 0 4px 0px var(--dark-red);
            transition: all 0.2s ease;
        }

        .btn-banner:hover {
            transform: translateY(2px);
            box-shadow: 0 2px 0px var(--dark-red);
        }

        .product-card {
            background-color: var(--shopin-red);
            border-radius: 16px;
            padding: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .product-image-container {
            background-color: white;
            border-radius: 10px;
            height: 170px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .search-bar {
            background-color: #F3F3F3;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- CABEÇALHO -->
    <?php include "UI/NAVBAR.php"; ?>

    <!-- BANNER DE DESTAQUE -->
    <section class="container mx-auto px-4 mt-8">
        <div class="promo-banner p-10 md:p-14 flex flex-col md:flex-row items-center justify-between">
            <div class="z-10 text-center md:text-left">
                <span class="bg-white/20 text-white px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest mb-4 inline-block">Destaque da Semana</span>
                <h2 class="font-pagkaki text-7xl md:text-8xl mb-2 leading-none">TV SMART SAMSUNG</h2>
                <p class="text-2xl font-light mb-6 italic opacity-90">60 Polegadas 4K Ultra HD</p>
                <div class="mb-8">

                    <span class="text-6xl font-black">R$2680,00</span>
                    <p class="text-lg font-bold opacity-80 mt-1">ou 12x sem juros no cartão</p>
                </div>
                <button class="btn-banner px-12 py-4 rounded-xl text-lg">COMPRAR AGORA</button>
            </div>

            <div class="mt-8 md:mt-0">
                <img src="img/tv_sam.webp" alt="TV" class="rounded-2xl shadow-2xl max-h-[380px] w-auto">
            </div>
        </div>
    </section>

    <!-- GRID DE PRODUTOS (IGUALADO 5 POR FILEIRA) -->
    <main class="container mx-auto px-4 my-12">
        <h2 class="font-pagkaki text-5xl text-shopin-red mb-8  border-shopin-terracota pl-4">Achados Arretados</h2>

        <!-- Grid configurado para 5 colunas no Desktop (lg:grid-cols-5) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

            <!-- Fileira 1 -->
            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="img/tenis.jpg" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Tênis Basquete Kobe Mambacita</h3>
                <p class="text-[10px] opacity-60 line-through mt-2">R$1999,99</p>
                <p class="font-cordel text-2xl">R$1299,99</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">12x sem juros</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="img/sela.webp" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Sela de Couro Legítimo Sertão</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$850,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">5x sem juros</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="img/tv_sam.webp" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">TV Smart Samsung 60" UHD 4K</h3>
                <p class="text-[10px] opacity-60 line-through mt-2">R$3350,99</p>
                <p class="font-cordel text-2xl">R$2680,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">12x sem juros</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="https://m.media-amazon.com/images/I/61W9Z-N3qJL._AC_SL1000_.jpg" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Castanha de Caju Torrada 1kg</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$89,90</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Frete Grátis</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="img/santa_ceia_entalhada.webp" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Santa Ceia Entalhada 3D</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$12.000</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Artesanato Único</p>
            </div>

            <!-- Fileira 2 (Mesmo número de produtos) -->
            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="https://m.media-amazon.com/images/I/71uV8I6Yk-L._AC_SL1500_.jpg" class="h-full object-cover"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Rede de Dormir Luxo Algodão</h3>
                <p class="text-[10px] opacity-60 line-through mt-2">R$220,00</p>
                <p class="font-cordel text-2xl">R$159,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Várias Cores</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="https://m.media-amazon.com/images/I/61NlU98mBPL._AC_SL1000_.jpg" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Mel de Jandaíra Puro 250ml</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$115,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Original RN</p>
            </div>

            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="img/alevinos.webp" class="h-full object-cover"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Alevinos de Tilápia 1000 Un.</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$650,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Entrega Segura</p>
            </div>

            <!-- Novo Produto 9 -->
            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="https://m.media-amazon.com/images/I/51wB7-7uLTL._AC_UX679_.jpg" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Chapéu de Couro do Sertão</h3>
                <p class="text-[10px] opacity-0 mt-2">spacer</p>
                <p class="font-cordel text-2xl">R$185,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Couro de Bode</p>
            </div>

            <!-- Novo Produto 10 (Para fechar a conta de 5 por fileira) -->
            <div class="product-card text-white">
                <div class="product-image-container mb-3"><img src="https://images.tcdn.com.br/img/editor/up/1057476/espeditoseleiro.jpg" class="h-4/5 object-contain"></div>
                <h3 class="text-[14px] uppercase font-bold leading-tight h-8">Sandália Estilo Espedito Seleiro</h3>
                <p class="text-[10px] opacity-60 line-through mt-2">R$350,00</p>
                <p class="font-cordel text-2xl">R$280,00</p>
                <p class="text-[10px] font-black bg-white/10 inline-block px-1 rounded">Arte em Couro</p>
            </div>

        </div>
    </main>

    <?php include "UI/footer.php"; ?>

</body>

</html>