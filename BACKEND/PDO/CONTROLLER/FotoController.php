<?php
require "../MODEL/Foto.php";
require "../DAO/FotoDAO.php";

$fotoObj = new Foto();
$dao = new FotoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_foto= isset($_POST['cod_foto']) ? $_POST['cod_foto'] : "";
$cod_prod = isset($_POST['cod_produto']) ? $_POST['cod_produto'] : "";
$foto_path = isset($_POST['foto']) ? $_POST['foto'] : "";

switch($acao){
    case "Inserir":
        $fotoObj->setCod_produto($cod_prod);
        $fotoObj->setFoto($foto_path);
        if($dao->inserir($fotoObj)){
            header("location: ../gerenciarFoto.php?prod=$cod_prod");
        }
    break;
    
    case "Apagar":
        if($dao->apagar($cod_foto)){
            header("location: ../gerenciarFoto.php?prod=$cod_prod");
        }
    break;
}
?>e