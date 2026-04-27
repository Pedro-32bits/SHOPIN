<?php
require "../PDO/MODEL/Admin.php";
require "../PDO/DAO/AdminDAO";

$admin =  new Admin();
$dao = new AdminDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$acao = isset($_POST['cod_admin']) ? $_POST['cod_admin'] : "";
$acao = isset($_POST['login']) ? $_POST['login'] : "";
$acao = isset($_POST['nome']) ? $_POST['nome'] : "";
$acao = isset($_POST['email']) ? $_POST['senha'] : "";
$acao = isset($_POST['senha']) ? $_POST['senha'] : "";

    switch($acao){
        case"Logar":
            $resultado =  $dao -> logar($login, $nome, $email, $senha);
                if ($resultado != false){
                    session_start();
                    $_SESSION['login'] = $resultado['login'];
                    $_SESSION['nome'] = $resultado['nome'];
                    $_SESSION['email'] = $resultado['email'];
                    $_SESSION['senha'] = $resultado['senha'];
                    header("location: ../");
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
            header("location ../login.php?erro=1");
        }
    break;

    case "atualizar":
        $admin -> setCod_admin($cod_admin);
        $admin -> setLogin($login);
        $admin -> setNome($nome);
        $admin -> setSenha($senha);
        $admin -> setEmail($email);  
        if ($dao -> atualizar($admin)){
            header("location: ../casdastro.php");
        }
        else{
            header("location: ../cadastro.php ?erro=3");
        }
    break;

    case "Apagar":
        if ($dao -> apagar($cod_admin)){
            header("location: ../cadastroAdmin.php");
        }
        else {
            header("location: ../castroAdmin.php? erro=2");
        }
        break;

    default:
        echo "Ação não reconhecida";
    break;
        
                }

?>