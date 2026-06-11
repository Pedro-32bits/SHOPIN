<?php
require "../MODEL/Categoria.php";
require "../DAO/CategoriaDAO.php";

$categoria = new Categoria();
$dao = new CategoriaDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod  = isset($_POST['cod_categoria']) ? $_POST['cod_categoria'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";

switch($acao){
    case "Inserir":
        $categoria->setNome($nome);
        if($dao->inserir($categoria)){
            header("location: ../listarCategorias.php");
        } else {
            header("location: ../cadastroCategoria.php?erro=1");
        }
    break;

    case "atualizar":
        $categoria->setCod_categoria($cod);
        $categoria->setNome($nome);
        if ($dao->atualizar($categoria)){
            header("location: ../listarCategorias.php");
        } else {
            header("location: ../cadastroCategoria.php?erro=3");
        }
    break;

    case "Apagar":
        if ($dao->apagar($cod)){
            header("location: ../listarCategorias.php");
        } else {
            header("location: ../listarCategorias.php?erro=2");
        }
    break;

    default:
        echo "Ação não reconhecida";
    break;
}
?>