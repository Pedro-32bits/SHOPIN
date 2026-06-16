<?php
require "../MODEL/Possui.php";
require "../DAO/PossuiDAO.php";

$possui = new Possui();
$dao = new PossuiDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_ped = isset($_POST['cod_pedido']) ? $_POST['cod_pedido'] : "";
$cod_prod = isset($_POST['cod_produto']) ? $_POST['cod_produto'] : "";
$qnt = isset($_POST['qnt']) ? $_POST['qnt'] : "";
$avaliacao = isset($_POST['avaliacao']) ? $_POST['avaliacao'] : "";
$resenha  = isset($_POST['resenha']) ? $_POST['resenha'] : "";
$data_avaliacao = isset($_POST['data_avaliacao']) ? $_POST['data_avaliacao'] : "";

switch($acao){
    case "Inserir":
        $possui->setCodPedido($cod_ped);
        $possui->setCodProduto($cod_prod);
        $possui->setQnt($qnt);
        $possui->setAvaliacao($avaliacao);
        $possui->setResenha($resenha);
        $possui->setDataAvaliacao($data_avaliacao);
        
        if($dao->inserir($possui)){
            header("location: ../carrinho.php");
        }
    break;

    case "Apagar":
        if($dao->apagar($cod_ped, $cod_prod)){
            header("location: ../carrinho.php");
        }
    break;
}
?>