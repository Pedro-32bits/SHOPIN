<?php
    class PossuiDAO {

        // Create - Inserir item no pedido
        function inserir($possui) {
            include __DIR__ . "/../conexao.php";
            $sql = "INSERT INTO possui (cod_pedido, cod_produto, qnt, avaliacao, resenha, data_avaliacao) VALUES (:cod_pedido, :cod_produto, :qnt, :avaliacao, :resenha, :data_avaliacao)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $possui->getCodPedido());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());
            $consulta->bindValue(":data_avaliacao", $possui->getDataAvaliacao());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        function listar() {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM possui";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function atualizar($possui) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE possui SET qnt=:qnt, avaliacao=:avaliacao, resenha=:resenha, data_avaliacao=:data_avaliacao WHERE cod_possui = :cod_possui AND cod_produto = :cod_produto";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_possui", $possui->getCodPossui());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());
            $consulta->bindValue(":data_avaliacao", $possui->getDataAvaliacao());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }
        function apagar($cod_pedido, $cod_produto) {
            include __DIR__ . "/../conexao.php";
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
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM possui WHERE cod_pedido = :cod_pedido";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>