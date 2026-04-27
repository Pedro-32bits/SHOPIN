<?php
require "../MODEL/Logistica.php";
require "../DAO/LogisticaDAO.php";

$logistica = new Logistica();
$dao = new LogisticaDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_log = isset($_POST['cod_logistica']) ? $_POST['cod_logistica'] : "";
$status = isset($_POST['status_entrega']) ? $_POST['status_entrega'] : "";
$local = isset($_POST['local_produto']) ? $_POST['local_produto'] : "";

switch($acao){
    case "atualizar":
        $logistica->setCodLogistica($cod_log);
        $logistica->setStatusEntrega($status);
        $logistica->setLocalProduto($local);
        
        if($dao->atualizar($logistica)){
            header("location: ../painelLogistica.php");
        }
    break;
}
?>