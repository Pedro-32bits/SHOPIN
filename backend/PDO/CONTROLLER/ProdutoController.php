<?php
require "../PDO/MODEL/Produto.php";
require "../PDO/DAO/ProdutoDAO";

$produto =  new Produto();
$dao = new ProdutoDAO();

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
$acao = isset($_POST['cod_produto']) ? $_POST['cod_produto'] : "";
$acao = isset($_POST['cod_vendedor']) ? $_POST['cod_vendedor'] : "";
$acao = isset($_POST['cod_categoria']) ? $_POST['cod_categoria'] : "";
$acao = isset($_POST['nome']) ? $_POST['nome'] : "";
$acao = isset($_POST['marca']) ? $_POST['marca'] : "";
$acao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
$acao = isset($_POST['valor']) ? $_POST['valor'] : "";
$acao = isset($_POST['promocao']) ? $_POST['promocao'] : "";  

    switch($acao){
       /* case"Logar":
            $resultado =  $dao -> logar(, $nome, $email, $senha);
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
        break;*/

        case "Inserir":
            $produto -> setNome($nome);
            $produto -> setMarca($marca);
            $produto -> setDescricao($descricao);
            $produto -> setValor($valor);
            

        if($dao -> inserir($produto)){
            header("location: ../login.php");
        }
        else{
            header("location ../login.php?erro=1");
        }
    break;

    case "atualizar":
        $produto -> setCod_produto($cod_produto);
        $produto -> setCod_vendedor($cod_vendedor);
        $produto -> setCod_categoria($cod_cateoria);
        $produto -> setNome($nome);
        $produto -> setMarca($marca);
        $produto -> setDescricao($descricao);
        $produto -> setValor($valor);
        $produto -> setPromocao($promocao);
             
        if ($dao -> atualizar($produto)){
            header("location: ../casdastro.php");
        }
        else{
            header("location: ../cadastro.php ?erro=3");
        }
    break;

    case "Apagar":
        if ($dao -> apagar($cod_produto)){
            header("location: ../cadastroProduto.php");
        }
        else {
            header("location: ../castroProduto.php? erro=2");
        }
        break;

    default:
        echo "Ação não reconhecida";
    break;
        
                }

?>