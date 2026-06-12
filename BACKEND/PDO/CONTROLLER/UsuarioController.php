<?php
include __DIR__ . "/../MODEL/Usuario.php";
include __DIR__ . "/../DAO/UsuarioDAO.php";

$usuario = new Usuario();
$dao = new UsuarioDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_usuario  = isset($_POST['cod_usuario']) ? $_POST['cod_usuario'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
$cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : "";
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
$senha = isset($_POST['senha']) ? $_POST['senha'] : "";
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$validacao = isset($_POST['validacao']) ? $_POST['validacao'] : "";

session_start();

switch ($acao) {
    case "Logar":
        $resultado = $dao->logar($email, $senha);
        if ($resultado != false) {
            $_SESSION['cod_usuario'] = $resultado['cod_usuario'];
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['senha'] = $resultado['senha'];
            $_SESSION['tipo'] = $resultado['tipo'] ?? 'cliente';

            if($_SESSION['tipo']=== 'cliente'){
                header("location: ../../../FRONTEND/cliente/usuario.php");
            }else{
                header("location ../../../FRONTEND/vendedor/vendedor.php");
                }
            
        }else  {
                header("location: ../../../FRONTEND/index.php?erro=4");
        }
        
        break;

//😍<-marcos

    case "Inserir":
        

        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTelefone($telefone);
        $usuario->setCpf($cpf);
        $usuario->setCnpj($cnpj);
        $usuario->setTipo($tipo);

        $novoCod = $dao->inserir($usuario);
        if ($novoCod !== false) {
            $_SESSION['cod_usuario'] = $novoCod;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = $nome;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['telefone'] = $telefone;
            header("location: ../../../FRONTEND/index.php");
        } else {
            header("location: ../../../FRONTEND/index.php?erro=1");
        }
        break;

    case "atualizar":
        $usuario->setCodUsuario($cod_usuario);
        $usuario->setSenha($senha);
        $usuario->setCPF($cpf);
        $usuario->setCNPJ($cnpj);
        $usuario->setEmail($email);
        $usuario->setTelefone($telefone);
        $usuario->setTipo($tipo);
        $usuario->setNome($nome);
        $_SESSION['cpf'] = $cpf;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['tipo'] = $tipo;

        if ($dao->atualizar($usuario)) {
            header("location: ../../../FRONTEND/index.php");
        } else {
            header("location: ../../../FRONTEND/index.php?erro=3");
        }
        break;

    case "Apagar":
        if ($dao->apagar($cod_usuario)) {
            header("location: ../../../FRONTEND/index.php");
        } else {
            header("location: ../../../FRONTEND/index.php?erro=2");
        }
        break;

    case "tornarVendedor":
        if (!isset($_SESSION)) {session_start();}

        if (isset($_SESSION['cod_usuario'])) { 
            $cod_usuario = $_SESSION['cod_usuario'];
            $resultado = $dao->tornarVendedor($cod_usuario);
            if ($resultado == true) { $_SESSION['tipo'] = "vendedor";
                header("Location: ../../../FRONTEND/vendedor/vendedor.php");
            } else {
                header("Location: ../../../FRONTEND/vendedor/cadastroVend.php?erro=1");
            }
        } else {
            header("Location: ../../../FRONTEND/index.php?erro=4");
        }
        break;



    default:
        echo "Ação não reconhecida";
        break;
}
