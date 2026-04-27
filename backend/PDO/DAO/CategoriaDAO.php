<?php
    class CategoriaDAO {

        // Create - Inserir
        function inserir($categoria) {
            include "../PDO/conexao.php";
            $sql = "INSERT INTO categoria (nome) VALUES (:nome)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":nome", $categoria->getNome());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos
        function listar() {
            include "../PDO/conexao.php";
            $sql = "SELECT * FROM categoria";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($categoria) {
            include "../PDO/conexao.php";
            $sql = "UPDATE categoria SET nome = :nome WHERE cod_categoria = :cod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $categoria->getCodCategoria());
            $consulta->bindValue(":nome", $categoria->getNome());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar
        function apagar($cod) {
            include "../PDO/conexao.php";
            $sql = "DELETE FROM categoria WHERE cod_categoria = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar por nome (Pesquisa)
        function buscar($pesquisa) {
            include "../PDO/conexao.php";
            $sql = "SELECT * FROM categoria WHERE nome LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>