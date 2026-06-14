<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPIN A | O Marketplace do Nordeste</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.0.0/dist/flowbite.min.js"></script>
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
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 20%, rgba(245, 207, 105, 0.32), transparent 30%),
                radial-gradient(circle at 82% 14%, rgba(255, 255, 255, 0.2), transparent 24%),
                linear-gradient(135deg, #A30F06 0%, #7f0b04 58%, #4e0905 100%);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 2rem;
            color: white;
            box-shadow: 0 22px 55px rgba(90, 18, 10, 0.28);
        }

        .promo-banner::before,
        .promo-banner::after {
            content: "";
            position: absolute;
            pointer-events: none;
        }

        .promo-banner::before {
            width: 220px;
            height: 220px;
            right: -70px;
            top: -75px;
            border: 34px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .promo-banner::after {
            left: 0;
            right: 0;
            bottom: 0;
            height: 12px;
            background: repeating-linear-gradient(90deg, #f5cf69 0 38px, #ffffff 38px 76px, #A30F06 76px 114px);
        }

        .promo-slide {
            background:
                linear-gradient(100deg, rgba(255, 255, 255, 0.17), rgba(255, 255, 255, 0.06)),
                rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(8px);
        }

        .promo-product-slide {
            background:
                linear-gradient(115deg, rgba(255, 255, 255, 0.18), rgba(255, 255, 255, 0.06)),
                rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(8px);
        }

        .promo-badge {
            background: #f5cf69;
            color: #5d0b05;
            box-shadow: 0 7px 0 rgba(77, 9, 5, 0.35);
        }

        .promo-thumb {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
        }

        .btn-banner {
            background-color: white;
            color: var(--shopin-red);
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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

    <?php
    require __DIR__ . "/../BACKEND/PDO/DAO/ProdutoDAO.php";
    $produtoDao = new ProdutoDAO();
    $produtos = $produtoDao->listarComFotos();
    $produtosDoCarrossel = array_values(array_filter($produtos, function ($produto) {
        return !empty($produto['promocao'])
            && (float)$produto['promocao'] > 0
            && (float)$produto['promocao'] < (float)$produto['valor'];
    }));

    if ($produtosDoCarrossel) {
        $produtosDoCarrossel = array_slice($produtosDoCarrossel, 0, 5);
    }
    ?>

    <!-- BANNER DE PROMOCOES -->
    <section class="container mx-auto px-4 mt-8">
        <div class="promo-banner px-5 py-6 md:px-8 md:py-8">
            <?php if (!empty($produtosDoCarrossel)): ?>
                <div id="promo-carousel" class="relative z-10">
                    <div class="relative min-h-[520px] overflow-hidden rounded-[1.65rem] md:min-h-[440px]">
                        <?php foreach ($produtosDoCarrossel as $index => $p): ?>
                            <?php
                            $foto = !empty($p['foto']) ? $p['foto'] : 'img/placeholder.php';
                            $valorOriginal = (float)$p['valor'];
                            $precoPromocional = (float)$p['promocao'];
                            $desconto = $valorOriginal > 0 ? round((($valorOriginal - $precoPromocional) / $valorOriginal) * 100) : 0;
                            ?>
                            <a href="produto.php?cod=<?php echo $p['cod_produto']; ?>"
                                class="promo-product-slide <?php echo $index === 0 ? 'flex' : 'hidden'; ?> min-h-[520px] w-full items-center justify-center rounded-[1.65rem] p-5 text-white no-underline shadow-2xl transition hover:no-underline md:min-h-[440px] md:p-8">
                                <article class="grid w-full max-w-6xl items-center gap-7 md:grid-cols-[1fr_1.05fr]">
                                    <div class="order-1 flex justify-center md:order-1">
                                        <div class="relative flex h-72 w-full max-w-md items-center justify-center rounded-[1.5rem] bg-white p-6 shadow-[0_25px_55px_rgba(0,0,0,0.24)] md:h-80 md:max-w-lg">
                                            <span class="promo-badge absolute -right-3 -top-3 rounded-2xl px-4 py-3 text-sm font-black uppercase leading-none">
                                                <?php echo $desconto; ?>% off
                                            </span>
                                            <img src="<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>" class="max-h-full w-full object-contain" onerror="this.src='img/placeholder.php'">
                                        </div>
                                    </div>

                                    <div class="order-2 text-center md:text-left">
                                        <span class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-2 text-[10px] font-black uppercase tracking-[0.28em] text-white ring-1 ring-white/25">
                                            <i class="fa-solid fa-bolt"></i> Oferta em destaque
                                        </span>
                                        <h2 class="mt-5 break-words font-pagkaki text-4xl leading-tight md:text-6xl"><?php echo htmlspecialchars($p['nome']); ?></h2>
                                        <p class="mt-3 text-sm font-semibold text-white/80 md:text-base">
                                            <?php echo !empty($p['descricao']) ? htmlspecialchars($p['descricao']) : 'Produto selecionado com preco especial na Shopin.'; ?>
                                        </p>

                                        <div class="mt-6 flex flex-wrap items-end justify-center gap-3 md:justify-start">
                                            <span class="text-base font-bold text-white/60 line-through">R$<?php echo number_format($valorOriginal, 2, ',', '.'); ?></span>
                                            <span class="font-cordel text-5xl leading-none text-[#f5cf69] md:text-6xl">R$<?php echo number_format($precoPromocional, 2, ',', '.'); ?></span>
                                        </div>

                                        <span class="btn-banner mt-7 inline-flex items-center gap-2 rounded-full px-7 py-3 text-xs">
                                            Ver produto <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </article>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <?php if (count($produtosDoCarrossel) > 1): ?>
                        <button type="button" class="promo-prev absolute left-3 top-1/2 z-30 flex -translate-y-1/2 items-center justify-center text-white focus:outline-none md:left-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-black/35 shadow-lg transition hover:bg-black/55">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                        </button>
                        <button type="button" class="promo-next absolute right-3 top-1/2 z-30 flex -translate-y-1/2 items-center justify-center text-white focus:outline-none md:right-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-black/35 shadow-lg transition hover:bg-black/55">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="relative z-10 rounded-3xl border border-white/20 bg-white/10 p-8 text-center text-white shadow-xl">
                    Nenhum produto em promocao no momento.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (false): ?>
    <!-- BANNER DE DESTAQUE -->
    <section class="container mx-auto px-4 mt-8">
        <div class="promo-banner p-6 md:p-8">
            <div class="mb-4">
                <span class="bg-white/20 text-white px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest mb-3 inline-block">Destaque da Semana</span>
                <h2 class="font-pagkaki text-3xl md:text-5xl leading-tight">Promoções da Shopin</h2>
            </div>

            <?php if (!empty($produtosDoCarrossel)): ?>
                <div id="animation-carousel" class="relative w-full" data-carousel="static">
                    <div class="relative h-[360px] overflow-hidden rounded-3xl md:h-[420px]">
                        <?php foreach ($produtosDoCarrossel as $index => $p): ?>
                            <?php
                            $foto = !empty($p['foto']) ? $p['foto'] : 'img/placeholder.php';
                            $preco = !empty($p['promocao']) && (float)$p['promocao'] > 0
                                ? (float)$p['promocao']
                                : (float)$p['valor'];
                            ?>
                            <a href="produto.php?cod=<?php echo $p['cod_produto']; ?>"
                                class="hidden h-full duration-200 ease-linear" data-carousel-item>
                                <article class="flex h-full w-full items-center justify-between gap-6 rounded-3xl bg-white/10 p-5 text-white shadow-2xl md:p-8">
                                    <div class="w-full text-center md:max-w-md md:text-left">
                                        <p class="text-[11px] uppercase tracking-[0.35em] text-white/80">Destaque</p>
                                        <h3 class="mt-3 font-pagkaki text-2xl md:text-4xl leading-tight"><?php echo htmlspecialchars($p['nome']); ?></h3>
                                        <p class="mt-3 text-white/90">Confira este produto em destaque na Shopin.</p>
                                        <p class="mt-4 text-3xl font-black md:text-4xl">R$<?php echo number_format($preco, 2, ',', '.'); ?></p>
                                    </div>
                                    <div class="w-full md:w-[320px]">
                                        <div class="rounded-3xl bg-white p-4 shadow-2xl">
                                            <img src="<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>" class="mx-auto h-40 w-full object-contain md:h-52" onerror="this.src='img/placeholder.php'">
                                        </div>
                                    </div>
                                </article>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="absolute start-0 top-0 z-30 flex h-full items-center justify-center px-3 text-white group focus:outline-none md:px-4" data-carousel-prev>
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-black/30 transition hover:bg-black/50">
                            <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 19-7-7 7-7" />
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="absolute end-0 top-0 z-30 flex h-full items-center justify-center px-3 text-white group focus:outline-none md:px-4" data-carousel-next>
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-black/30 transition hover:bg-black/50">
                            <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                            </svg>
                        </span>
                    </button>
                </div>
            <?php else: ?>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-8 text-center text-white shadow-xl">Nenhum produto disponível no momento.</div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>



    <!-- GRID DE PRODUTOS -->
    <main class="container mx-auto px-4 my-12">
        <h2 class="font-pagkaki text-5xl text-shopin-red mb-8  border-shopin-redpl-4">Achados Arretados</h2>


        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

            <?php foreach ($produtos as $p): ?>
                <?php $foto = !empty($p['foto']) ? $p['foto'] : 'img/placeholder.php'; ?>
                <a href="produto.php?cod=<?php echo $p['cod_produto']; ?>" class="product-card text-white block no-underline hover:no-underline">
                    <div class="product-image-container mb-3"><img src="<?php echo htmlspecialchars($foto); ?>" class="h-4/5 object-contain" onerror="this.src='img/placeholder.php'"></div>
                    <h3 class="text-[14px] uppercase font-bold leading-tight h-8"><?php echo htmlspecialchars($p['nome']); ?></h3>
                    <?php if (!empty($p['promocao']) && $p['promocao'] > 0): ?>
                        <p class="text-[10px] opacity-60 line-through mt-2">R$<?php echo number_format($p['valor'], 2, ',', '.'); ?></p>
                        <p class="font-cordel text-2xl">R$<?php echo number_format($p['promocao'], 2, ',', '.'); ?></p>

                    <?php else: ?>

                        <p class="text-[10px] opacity-0 mt-2">spacer</p>
                        <p class="font-cordel text-2xl">R$<?php echo number_format($p['valor'], 2, ',', '.'); ?></p>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>

        </div>
    </main>

    <?php include "UI/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('promo-carousel');
            if (!carousel) {
                return;
            }

            const slides = carousel.querySelectorAll('.promo-product-slide');
            const previousButton = carousel.querySelector('.promo-prev');
            const nextButton = carousel.querySelector('.promo-next');
            let currentSlide = 0;

            function showSlide(nextSlide) {
                slides[currentSlide].classList.add('hidden');
                slides[currentSlide].classList.remove('flex');
                slides[nextSlide].classList.remove('hidden');
                slides[nextSlide].classList.add('flex');
                currentSlide = nextSlide;
            }

            if (previousButton) {
                previousButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    showSlide((currentSlide - 1 + slides.length) % slides.length);
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    showSlide((currentSlide + 1) % slides.length);
                });
            }
        });
    </script>

</body>
<?php echo ob_get_clean(); ?>

</html>
