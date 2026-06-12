<?php
    class FotoDAO {

        // Create - Inserir
        function inserir($fotoObj) {
            include __DIR__ . "/../conexao.php";

            try {
                $sql = "INSERT INTO foto (cod_produto, foto) VALUES (:cod_produto, :foto)";
                $consulta = $conexao->prepare($sql);
                $consulta->bindValue(":cod_produto", (int) $fotoObj->getCod_produto());
                $consulta->bindValue(":foto", (string) $fotoObj->getFoto());

                return $consulta->execute();
            } catch (PDOException $e) {
                error_log("Erro ao salvar foto: " . $e->getMessage());
                return false;
            }
        }

        // Read - Listar todas as fotos
        function listar() {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($fotoObj) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE foto SET cod_produto = :cod_produto, foto = :foto WHERE cod_foto = :cod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $fotoObj->getCod_foto());
            $consulta->bindValue(":cod_produto", $fotoObj->getCod_produto());
            $consulta->bindValue(":foto", $fotoObj->getFoto());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar por PK
        function apagar($fotoObj) {
            include __DIR__ . "/../conexao.php";
            $sql = "DELETE FROM foto WHERE cod_foto = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $fotoObj->getCod_foto());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar (Pesquisa por nome do arquivo da foto ou código do produto)
        function buscar($pesquisa) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto WHERE foto LIKE :pesquisa OR cod_produto = :cod_prod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->bindValue(":cod_prod", $pesquisa); 
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 

         function buscarPorProduto($cod_produto) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto WHERE cod_produto = :cod_produto";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
?>