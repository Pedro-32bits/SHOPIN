<?php
require "../MODEL/Admin.php";
require "../DAO/AdminDAO.php";

$admin =  new Admin();
$dao = new AdminDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$cod_admin = isset($_POST['cod_admin']) ? $_POST['cod_admin'] : "";
$login = isset($_POST['login']) ? $_POST['login'] : "";
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$senha = isset($_POST['senha']) ? $_POST['senha'] : "";

    switch($acao){
        case "Logar":
            $admin->setLogin($login);
            $admin->setSenha($senha);
            $resultado = $dao->logar($admin);
            if ($resultado != false){
                    session_start();
                    $_SESSION['login'] = $resultado['login'];
                    $_SESSION['nome'] = $resultado['nome'];
                    $_SESSION['email'] = $resultado['email'];
                    $_SESSION['senha'] = $resultado['senha'];
                    header("location: ../index.php");
                }
                else{
                    header("location: ../login? erro=4");
                }
        break;

        case "Inserir":
            $admin -> setLogin($login);
            $admin -> setNome($nome);
            $admin -> setSenha($senha);
            $admin -> setEmail($email);

        if($dao -> inserir($admin)){
            header("location: ../login.php");
        }
        else{
            header("location: ../login.php?erro=1");
        }
    break;

    case "atualizar":
        $admin -> setCod_admin($cod_admin);
        $admin -> setLogin($login);
        $admin -> setNome($nome);
        $admin -> setSenha($senha);
        $admin -> setEmail($email);  
        if ($dao -> atualizar($admin)){
            header("location: ../cadastro.php");
        }
        else{
            header("location: ../cadastro.php?erro=3");
        }
    break;

    case "Apagar":
        if ($dao -> apagar($cod_admin)){
            header("location: ../cadastroAdmin.php");
        }
        else {
            header("location: ../cadastroAdmin.php?erro=2");
        }
        break;

    default:
        echo "Ação não reconhecida";
    break;
        
                }

?>