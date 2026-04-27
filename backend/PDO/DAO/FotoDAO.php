<?php
    class FotoDAO {

        // Create - Inserir
        function inserir($fotoObjeto) {
            include "../BACKEND/PDO/conexao.php"; // Seguindo o padrão de include do modelo
            $sql = "INSERT INTO foto (cod_produto, foto) VALUES (:cod_produto, :foto)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_produto", $fotoObjeto->getCodProduto());
            $consulta->bindValue(":foto", $fotoObjeto->getFoto());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todas as fotos
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM foto";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($fotoObjeto) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE foto SET cod_produto = :cod_produto, foto = :foto WHERE foto_PK = :cod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $fotoObjeto->getFotoPK());
            $consulta->bindValue(":cod_produto", $fotoObjeto->getCodProduto());
            $consulta->bindValue(":foto", $fotoObjeto->getFoto());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar por PK
        function apagar($cod) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM foto WHERE foto_PK = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar (Pesquisa por nome do arquivo da foto ou código do produto)
        function buscar($pesquisa) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM foto WHERE foto LIKE :pesquisa OR cod_produto = :cod_prod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->bindValue(":cod_prod", $pesquisa); 
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>