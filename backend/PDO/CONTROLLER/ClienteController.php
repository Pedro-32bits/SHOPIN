<?php
require "../MODEL/Cliente.php";
require "../DAO/ClienteDAO.php";

$cliente = new Cliente();
$dao = new ClienteDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod  = isset($_POST['cod_cliente']) ? $_POST['cod_cliente'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$senha = isset($_POST['senha']) ? $_POST['senha'] : "";
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
$CPF = isset($_POST['CPF']) ? $_POST['CPF'] : "";
$foto = isset($_POST['foto']) ? $_POST['foto'] : "";

switch($acao){
    case "Logar": 
        $resultado = $dao->logar($email, $senha, $nome);
        if ($resultado != false){
            session_start();
            $_SESSION['cod_cliente'] = $resultado['cod_cliente'];
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['nome'] = $resultado['nome'];
            header("location: ../index.php");
        } else {
            header("location: ../loginCliente.php?erro=4");
        }
    break;

    case "Inserir":
        $cliente -> setNome($nome);
        $cliente -> setEmail($email);
        $cliente -> setSenha($senha);
        $cliente -> setTelefone($telefone);
        $cliente -> setCPF($CPF);
        $cliente -> setFoto($foto);

        if($dao->inserir($cliente)){
            header("location: ../loginCliente.php");
        } else {
            header("location: ../cadastroCliente.php?erro=1");
        }
    break;

    case "atualizar":
        $cliente->setCod_cliente($cod);
        $cliente->setNome($nome);
        $cliente->setEmail($email);
        $cliente->setSenha($senha);
        $cliente->setTelefone($telefone);
        $cliente->setCPF($CPF);
        $cliente->setFoto($foto);

        if ($dao->atualizar($cliente)){
            header("location: ../perfilCliente.php");
        } else {
            header("location: ../perfilCliente.php?erro=3");
        }
    break;

    case "Apagar":
        if ($dao->apagar($cod)){
            header("location: ../index.php");
        } else {
            header("location: ../perfilCliente.php?erro=2");
        }
    break;
}
?>