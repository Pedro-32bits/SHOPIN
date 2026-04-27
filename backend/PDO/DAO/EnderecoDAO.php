<?php
    class EnderecoDAO {

        // Create - Inserir 
        function inserir($endereco) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "INSERT INTO endereco (cod_cliente, cod_vendedor, CEP, rua, bairro, ponto_referencia, num_casa) 
                    VALUES (:cod_cliente, :cod_vendedor, :CEP, :rua, :bairro, :ponto_referencia, :num_casa)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_cliente", $endereco->getCodCliente());
            $consulta->bindValue(":cod_vendedor", $endereco->getCodVendedor());
            $consulta->bindValue(":CEP", $endereco->getCEP());
            $consulta->bindValue(":rua", $endereco->getRua());
            $consulta->bindValue(":bairro", $endereco->getBairro());
            $consulta->bindValue(":ponto_referencia", $endereco->getPontoReferencia());
            $consulta->bindValue(":num_casa", $endereco->getNumCasa());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM endereco";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($endereco) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE endereco SET 
                    cod_cliente=:cod_cliente, 
                    cod_vendedor=:cod_vendedor, 
                    CEP=:CEP, 
                    rua=:rua, 
                    bairro=:bairro, 
                    ponto_referencia=:ponto_referencia, 
                    num_casa=:num_casa 
                    WHERE cod_endereco = :cod";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $endereco->getCodEndereco());
            $consulta->bindValue(":cod_cliente", $endereco->getCodCliente());
            $consulta->bindValue(":cod_vendedor", $endereco->getCodVendedor());
            $consulta->bindValue(":CEP", $endereco->getCEP());
            $consulta->bindValue(":rua", $endereco->getRua());
            $consulta->bindValue(":bairro", $endereco->getBairro());
            $consulta->bindValue(":ponto_referencia", $endereco->getPontoReferencia());
            $consulta->bindValue(":num_casa", $endereco->getNumCasa());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar 
        function apagar($cod) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM endereco WHERE cod_endereco = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar por CEP ou Rua (Pesquisa adaptada)
        function buscar($pesquisa) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM endereco WHERE rua LIKE :pesquisa OR CEP LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>