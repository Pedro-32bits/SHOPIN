<?php
require "../MODEL/Vendedor.php";
require "../DAO/VendedorDAO.php";

$vendedor =  new Vendedor();
$dao = new VendedorDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod  = isset($_POST['cod']) ? $_POST['cod'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$CPF = isset($_POST['CPF']) ? $_POST['CPF'] : "";
$CNPJ = isset($_POST['CNPJ']) ? $_POST['CNPJ'] : "";
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
$senha =  isset ($_POST['senha']) ? $_POST['senha']
 : "";
$foto = isset($_POST['foto']) ? $_POST['foto'] : "";


switch($acao){
    case "Logar": 
        $resultado = $dao -> logar ($email, $senha, $nome);
        if ($resultado !=false){
            session_start();
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['senha'] = $resultado['senha'];
            $_SESSION['nome'] = $resultado ['nome'];
            $_SESSION['telefone'] = $resultado ['telefone'];

            header("location: ../../../FRONTEND/vendedor/vendedor.php");
        }
        else{
            header("location: ../../../FRONTEND/vendedor/loginVend.php?erro=4");
        }
    break;

    case "Inserir":
        $vendedor -> setSenha($senha);
        $vendedor -> setEmail($email);
        $vendedor -> setCPF($CPF);
        $vendedor -> setCNPJ($CNPJ);
        $vendedor -> setFoto($foto);
        $vendedor -> setNome($nome);
        $vendedor -> setTelefone($telefone);

        if($dao -> inserir($vendedor)){
            header("location: ../../../FRONTEND/vendedor/vendedor.php");
        }
        else{
            header("location: ../../../FRONTEND/vendedor/loginVend.php?erro=1");
        }
    break;

    case "atualizar":
        $vendedor -> setCod($cod);
        $vendedor -> setSenha($senha);
        $vendedor -> setCPF($CPF);
        $vendedor -> setCNPJ($CNPJ); 
        $vendedor -> setEmail($email);
        $vendedor -> setTelefone($telefone);
        $vendedor -> setFoto($foto);
        $vendedor -> setNome($nome);

        if ($dao -> atualizar($vendedor)){
            header("location: ../../../FRONTEND/vendedor/vendedor.php");
        }
        else{
            header("location: ../../../FRONTEND/vendedor/cadastroVend.php?erro=3");
        }
    break;

    case "Apagar":
        if ($dao -> apagar($cod)){
            header("location: ../../../FRONTEND/vendedor/vendedor.php");
        }
        else {
            header("location: ../../../FRONTEND/vendedor/vendedor.php?erro=2");
        }
        break;

    default:
        echo "Ação não reconhecida";
    break;
        
                }
?>