<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Pesquisa - SHOPIN A</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metamorphous&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Pagkaki';
            src: url('fonts/Pagkaki-Regular.otf') format('opentype');
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
            margin: 0;
            padding: 0;
        }

        .font-pagkaki {
            font-family: 'Pagkaki', sans-serif;
        }

        .font-cordel {
            font-family: 'Metamorphous', serif;
            text-transform: uppercase;
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
    </style>
</head>

<body>
    <!-- CABEÇALHO -->
    <?php include "UI/NAVBAR.php"; ?>

    <?php
    require __DIR__ . "/../BACKEND/PDO/DAO/ProdutoDAO.php";
    $produtoDao = new ProdutoDAO();
    $produtos = $produtoDao->listarComFotos();
    $pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

    $produtos = [];
    if (!empty($pesquisa)) {
        $produtos = $produtoDao->buscar($pesquisa);
    }
    ?>

    <!-- CONTAINER DE RESULTADOS -->
    <main class="container mx-auto px-4 my-12">
        <div class="mb-8">
            <h2 class="font-pagkaki text-5xl text-shopin-red mb-2">Resultados da Pesquisa</h2>
            <p class="text-gray-600 text-lg">
                <?php if (!empty($pesquisa)): ?>
                    Buscando por: <span class="font-bold text-shopin-red"><?php echo htmlspecialchars($pesquisa); ?></span>
                    <br>
                    <?php echo count($produtos); ?> produto(s) encontrado(s)
                <?php else: ?>
                    Digite algo na barra de pesquisa para procurar
                <?php endif; ?>
            </p>
        </div>

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

    </main>

    <?php include "UI/footer.php"; ?>

</body>

</html>