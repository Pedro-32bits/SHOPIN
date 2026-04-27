<?php
    class PedidoDAO {

        // Create - Inserir um novo pedido
        function inserir($pedido) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "INSERT INTO pedido (cod_pedido, cod_cliente, formaPag, preco, cupom, validacao, notaF) 
                    VALUES (:cod_pedido, :cod_cliente, :formaPag, :preco, :cupom, :validacao, :notaF)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $pedido->getCodPedido());
            $consulta->bindValue(":cod_cliente", $pedido->getCodCliente());
            $consulta->bindValue(":formaPag", $pedido->getFormaPag());
            $consulta->bindValue(":preco", $pedido->getPreco());
            $consulta->bindValue(":cupom", $pedido->getCupom());
            $consulta->bindValue(":validacao", $pedido->getValidacao());
            $consulta->bindValue(":notaF", $pedido->getNotaF());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos os pedidos
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM pedido";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar dados do pedido
        function atualizar($pedido) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE pedido SET 
                    cod_cliente=:cod_cliente, 
                    formaPag=:formaPag, 
                    preco=:preco, 
                    cupom=:cupom, 
                    validacao=:validacao, 
                    notaF=:notaF 
                    WHERE cod_pedido = :cod";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $pedido->getCodPedido());
            $consulta->bindValue(":cod_cliente", $pedido->getCodCliente());
            $consulta->bindValue(":formaPag", $pedido->getFormaPag());
            $consulta->bindValue(":preco", $pedido->getPreco());
            $consulta->bindValue(":cupom", $pedido->getCupom());
            $consulta->bindValue(":validacao", $pedido->getValidacao());
            $consulta->bindValue(":notaF", $pedido->getNotaF());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar pedido
        function apagar($cod) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM pedido WHERE cod_pedido = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar por Código do Pedido ou Nota Fiscal
        function buscar($pesquisa) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM pedido WHERE cod_pedido LIKE :pesquisa OR notaF LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>