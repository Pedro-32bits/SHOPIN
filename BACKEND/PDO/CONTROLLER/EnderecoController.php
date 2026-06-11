<?php
require "../MODEL/Endereco.php";
require "../DAO/EnderecoDAO.php";

$endereco = new Endereco();
$dao = new EnderecoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_end = isset($_POST['cod_endereco']) ? $_POST['cod_endereco'] : "";
$cod_cli = isset($_POST['cod_cliente']) ? $_POST['cod_cliente'] : null;
$cod_ven = isset($_POST['cod_vendedor']) ? $_POST['cod_vendedor'] : null;
$CEP = isset($_POST['CEP']) ? $_POST['CEP'] : "";
$rua = isset($_POST['rua']) ? $_POST['rua'] : "";
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : "";
$ponto = isset($_POST['ponto_referencia']) ? $_POST['ponto_referencia'] : "";
$num = isset($_POST['num_casa']) ? $_POST['num_casa'] : "";

switch($acao){
    case "Inserir":
        $endereco->setCod_cliente($cod_cli);
        $endereco->setCod_vendedor($cod_ven);
        $endereco->setCEP($CEP);
        $endereco->setRua($rua);
        $endereco->setBairro($bairro);
        $endereco->setPonto_referencia($ponto_referencia);
        $endereco->setNum_casa($num_casa);

        if($dao->inserir($endereco)){
            header("location: ../meusEnderecos.php");
        } else {
            header("location: ../cadastroEndereco.php?erro=1");
        }
    break;

    case "atualizar":
        $endereco->setCod_endereco($cod_end);
        $endereco->setCEP($CEP);
        $endereco->setRua($rua);
        $endereco->setBairro($bairro);
        $endereco->setNum_casa($num_casa);
        // ... set outros campos
        if ($dao->atualizar($endereco)){
            header("location: ../meusEnderecos.php");
        } else {
            header("location: ../editarEndereco.php?erro=3");
        }
    break;
}
?>