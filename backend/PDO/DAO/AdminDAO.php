<?php 
class AdminDAO{
    //CRUD

    function inserir ($admin){
        include "../PDO/conexao.php";
            $sql ="INSERT INTO admin (cod_admin, login, nome, email, senha ) VALUES (:cod_admin, :login, :nome, :email, :senha)";
            $consulta = $conexao -> prepare($sql);
            $consulta ->bindValue (":login", $admin -> getLogin());
            $consulta ->bindValue(":nome", $admin -> getNome());
            $consulta ->bindValue(":email", $admin -> getEmail());
            $consulta ->bindValue(":senha", $admin -> getSenha());

            if ($consulta -> execute()){
                 return true;
            }else{
                return false;
            }
    }

    function listar(){
         include "../PDO/conexao.php";
            $sql = "SELECT * FROM admin";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchALL();
        }

    function atualizar($admin){
        include "../PDO/conexao.php";
            $sql ="UPDATE admin SET login=:login, nome=:nome, email=:email senha=:senha WHERE cod_admin=:cod_admin";
            $consulta -> $conexao -> prepare($sql);
            $consulta -> bindValue(":login", $admin -> getLogin());
            $consulta -> bindValue(":nome",$admin ->getNome());
            $consulta -> bindValue(":email", $admin -> getEmail());
            $consulta -> bindValue(":senha", $admin -> getSenha());

            if ($consulta -> execute()){
                return true ;
            }else {
                return false;
            }
            
        }

    function apagar($cod_admin){
        include "../PDO/conexao.php";
            $sql = "DELETE FROM admin WHERE cod_admin = :cod_admin";
            $consulta = $conexao ->prepare($sql);
            $consulta -> bindValue(":cod_admin", $cod_admin);

            if ($consulta -> execute()){
                return true;
            }else{
                return false;
            }

        }

    function logar($admin){
        include "../PDO/conexao.php";
            $sql = "SELECT FROM admin WHERE login=:login, nome=:nome, email=:email, senha=:senha";
            $consulta = $conexao -> prepare($sql);
            $consulta -> bindValue(":login", $login);
            $consulta -> bindValue(":nome", $nome);
            $consulta -> bindValue(":email", $email);
            $consulta -> bindValue(":senha", $senha);
            
            $consulta -> execute();
            return $consulta -> fecht();
            }
    function buscar($admin){
        include "conexao.php";
            $sql = "SELECT * FROM admin WHERE nome LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
    
