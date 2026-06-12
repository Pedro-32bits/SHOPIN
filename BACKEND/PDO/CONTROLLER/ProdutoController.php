<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /shopin/FRONTEND/index.php');
    exit();
}
require "../MODEL/Produto.php";
require "../DAO/ProdutoDAO.php";
require "../MODEL/Foto.php";
require "../DAO/FotoDAO.php";

session_start();

$produto =  new Produto();
$dao = new ProdutoDAO();
$fotoDao = new FotoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_produto = isset($_POST['cod_produto']) ? $_POST['cod_produto'] : "";
$cod_usuario = isset($_SESSION['cod_usuario']) ? $_SESSION['cod_usuario'] : (isset($_POST['cod_usuario']) ? $_POST['cod_usuario'] : "");
$cod_categoria = isset($_POST['cod_categoria']) ? $_POST['cod_categoria'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$marca = isset($_POST['marca']) ? $_POST['marca'] : "";
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
$valor = isset($_POST['valor']) ? $_POST['valor'] : "";
$promocao = isset($_POST['promocao']) ? $_POST['promocao'] : "";

switch ($acao) {
    case "Inserir":
        if (empty($cod_usuario)) {
            header("location: ../../shopin/FRONTEND/vendedor/loginVend.php");
            exit();
        }
        $produto->setCodUsuario($cod_usuario);
        $produto->setCod_categoria($cod_categoria);
        $produto->setNome($nome);
        $produto->setMarca($marca);
        $produto->setDescricao($descricao);
        $produto->setValor($valor);
        $produto->setPromocao($promocao);
        $produtoId = $dao->inserir($produto);
        if ($produtoId !== false) {
            if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['name'][0])) {
                $uploadDir = __DIR__ . "/../../shopin/FRONTEND/img/produtos/";

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (!is_writable($uploadDir)) {
                    die("Pasta de upload sem permissão de escrita.");
                }

                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                foreach ($_FILES['fotos']['name'] as $key => $originalName) {
                    if ($_FILES['fotos']['error'][$key] !== UPLOAD_ERR_OK) {
                        continue;
                    }

                    $tmpName = $_FILES['fotos']['tmp_name'][$key];
                    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    if (!in_array($ext, $allowedExt)) {
                        continue;
                    }

                    $safeName = time() . "_" . $produtoId . "_" . preg_replace('/[^A-Za-z0-9_.-]/', '_', basename($originalName));
                    $targetPath = $uploadDir . $safeName;

                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $fotoObj = new Foto();
                        $fotoObj->setCod_produto($produtoId);
                        $fotoObj->setFoto("img/produtos/" . $safeName);
                        $fotoDao->inserir($fotoObj);
                    }
                }
            }
            header("location: ../../shopin/FRONTEND/vendedor/vendedor.php");
        } else {
            header("location: ../../shopin/FRONTEND/vendedor/loginVend.php?erro=1");
        }
        break;

    case "atualizar":
        $produto->setCod_produto($cod_produto);
        $produto->setCodUsuario($cod_usuario);
        $produto->setCod_categoria($cod_categoria);
        $produto->setNome($nome);
        $produto->setMarca($marca);
        $produto->setDescricao($descricao);
        $produto->setValor($valor);
        $produto->setPromocao($promocao);

        if ($dao->atualizar($produto)) {
            header("location: ../../shopin/FRONTEND/vendedor/cadastro.php");
        } else {
            header("location: ../../shopin/FRONTEND/vendedor/cadastro.php?erro=3");
        }
        break;

    case "Apagar":
        if ($dao->apagar($cod_produto)) {
            header("location: ../../shopin/FRONTEND/vendedor/cadastroProduto.php");
        } else {
            header("location: ../../shopin/FRONTEND/vendedor/cadastroProduto.php? erro=2");
        }
        break;

    default:
        echo "Ação não reconhecida";
        break;
}
