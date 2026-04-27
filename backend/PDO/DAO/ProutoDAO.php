<?php
    class ProutoDAO{
            //CRUD
            //CRIAR * INSERIR
        function inserir ($produto){

            include "../PDO/conexao.php";
            $sql = "INSERT INTO produto (cod_produto, cod_produto, cod_categoria, nome, marca, descricao, valor, promocao) VALUES (:cod_produto, :cod_produto, :cod_categoria, :nome, :marca, :decricao, :valor, :promocao)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":marca", $produto->getMarca());
            $consulta->bindValue(":decricao", $produto->getDescricao());
            $consulta->bindValue(":valor", $produto->getValor());
            $consulta->bindValue(":promocao", $produto->getPromocao());
         
            if($consulta->execute()){
                return true;
            } else {
                return false;
            }
        }

        //READ * LER/LISTAR
        function listar(){
           include "../PDO/conexao.php";
            $sql = "SELECT * FROM produto";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchALL();
        }

                // UPDATE - ATUALIZAR
        function atualizar($produto){
            include "../PDO/conexao.php";
            $sql = "UPDATE produto SET nome=:nome, marca=:marca, descricao=:descricao, valor=:valor promocao=:promocao WHERE cod_produto = :cod_produto";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $produto->getCod_produto());
            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":marca", $produto->getMarca());
            $consulta->bindValue(":decricao", $produto->getDescricao());
            $consulta->bindValue(":valor", $produto->getValor());
            $consulta->bindValue(":promocao", $produto->getPromocao());
        
            if($consulta->execute()){
                return true;
            } else {
                return false;
            }

        }

        // DELETE - APAGAR
        function apagar($cod_produto){
           include "../PDO/conexao.php";
           $sql = "DELETE FROM produto WHERE cod_produto=:cod_produto";
           $consulta = $conexao->prepare($sql);
           $consulta->bindValue(":cod_produto", $cod_produto);
           if($consulta->execute()){
                return true;
           } else {
                return false;
           }
        }

        function logar($email,$senha){
            include "../conexao.php";
            $sql = "SELECT * FROM produto WHERE (email =:email) AND (senha=:senha)";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":email", $email);
            $consulta->bindValue(":senha", $senha);
            $consulta->execute();
            return $consulta->fetch();
        }
    
        function buscar($pesquisa){
            include "conexao.php";
            $sql = "SELECT * FROM produto WHERE nome LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
    
?>