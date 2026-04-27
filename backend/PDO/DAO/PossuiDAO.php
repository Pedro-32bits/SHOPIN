<?php
    class PossuiDAO {

        // Create - Inserir item no pedido
        function inserir($possui) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "INSERT INTO possui (cod_pedido, cod_produto, qnt, avaliacao, resenha) 
                    VALUES (:cod_pedido, :cod_produto, :qnt, :avaliacao, :resenha)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $possui->getCodPedido());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos os itens de todos os pedidos
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM possui";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar quantidade ou avaliação de um item específico
        function atualizar($possui) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE possui SET 
                    qnt=:qnt, 
                    avaliacao=:avaliacao, 
                    resenha=:resenha 
                    WHERE cod_pedido = :cod_pedido AND cod_produto = :cod_produto";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $possui->getCodPedido());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Remover um item específico de um pedido
        function apagar($cod_pedido, $cod_produto) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM possui WHERE cod_pedido = :cod_pedido AND cod_produto = :cod_produto"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->bindValue(":cod_produto", $cod_produto);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar itens de um pedido específico
        function buscarPorPedido($cod_pedido) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM possui WHERE cod_pedido = :cod_pedido";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>