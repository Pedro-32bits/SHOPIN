<?php
require "../MODEL/Endereco.php";
require "../DAO/EnderecoDAO.php";

$endereco = new Endereco();
$dao = new EnderecoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_endereco = isset($_POST['cod_endereco']) ? $_POST['cod_endereco'] : "";
$cod_usuario = isset($_POST['cod_usuario']) ? $_POST['cod_usuario'] : null;
$CEP = isset($_POST['CEP']) ? $_POST['CEP'] : "";
$rua = isset($_POST['rua']) ? $_POST['rua'] : "";
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : "";
$ponto_refencia = isset($_POST['ponto_referencia']) ? $_POST['ponto_referencia'] : "";
$num_casa = isset($_POST['num_casa']) ? $_POST['num_casa'] : "";

switch($acao){
    case "Inserir":
        $endereco->setCodUsuario($cod_usuario);
        $endereco->setCEP($CEP);
        $endereco->setRua($rua);
        $endereco->setBairro($bairro);
        $endereco->setPonto_referencia($ponto_refencia);
        $endereco->setNum_casa($num_casa);

        if($dao->inserir($endereco)){
           header("location: ../../../FRONTEND/cliente/usuario.php");
        } else {
            header("location: ../../../FRONTEND/cliente/usuario.php?erro=1");
        }
    break;

    case "atualizar":
        $endereco->setCod_endereco($cod_endereco);
        $endereco->setCEP($CEP);
        $endereco->setRua($rua);
        $endereco->setBairro($bairro);
        $endereco->setNum_casa($num_casa);
        // ... set outros campos
        if ($dao->atualizar($endereco)){
            header("location: ../../../FRONTEND/cliente/usuario.php");
        } else {
            header("location: ../../../FRONTEND/cliente/usuario.php?erro=3");
        }
    break;
}
?>