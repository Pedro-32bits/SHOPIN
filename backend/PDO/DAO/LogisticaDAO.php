<?php
    class LogisticaDAO {

        // Create - Inserir registro de logística
        function inserir($logistica) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "INSERT INTO logistica (cod_pedido, cod_vendedor, frete, local_produto, status_entrega) 
                    VALUES (:cod_pedido, :cod_vendedor, :frete, :local_produto, :status_entrega)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $logistica->getCodPedido());
            $consulta->bindValue(":cod_vendedor", $logistica->getCodVendedor());
            $consulta->bindValue(":frete", $logistica->getFrete());
            $consulta->bindValue(":local_produto", $logistica->getLocalProduto());
            $consulta->bindValue(":status_entrega", $logistica->getStatusEntrega());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos os registros
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM logistica";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar status ou localização
        function atualizar($logistica) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE logistica SET 
                    cod_pedido=:cod_pedido, 
                    cod_vendedor=:cod_vendedor, 
                    frete=:frete, 
                    local_produto=:local_produto, 
                    status_entrega=:status_entrega 
                    WHERE cod_logistica = :cod";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $logistica->getCodLogistica());
            $consulta->bindValue(":cod_pedido", $logistica->getCodPedido());
            $consulta->bindValue(":cod_vendedor", $logistica->getCodVendedor());
            $consulta->bindValue(":frete", $logistica->getFrete());
            $consulta->bindValue(":local_produto", $logistica->getLocalProduto());
            $consulta->bindValue(":status_entrega", $logistica->getStatusEntrega());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar registro
        function apagar($cod) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM logistica WHERE cod_logistica = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar por Código do Pedido ou Status
        function buscar($pesquisa) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM logistica WHERE cod_pedido LIKE :pesquisa OR status_entrega LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>