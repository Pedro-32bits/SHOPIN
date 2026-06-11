<?php
require "../MODEL/Pedido.php";
require "../DAO/PedidoDAO.php";

$pedido = new Pedido();
$dao = new PedidoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_ped = isset($_POST['cod_pedido']) ? $_POST['cod_pedido'] : "";
$formaPag = isset($_POST['formaPag']) ? $_POST['formaPag'] : "";
$preco = isset($_POST['preco']) ? $_POST['preco'] : "";

switch($acao){
    case "Inserir":
        $pedido->setCod_pedido($cod_ped);
        $pedido->setFormaPag($formaPag);
        $pedido->setPreco($preco);
        // ... set outros campos
        if($dao->inserir($pedido)){
            header("location: ../confirmacaoPedido.php");
        }
    break;
}
?>