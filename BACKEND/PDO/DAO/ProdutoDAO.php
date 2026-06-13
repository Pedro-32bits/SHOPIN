<?php
    class ProdutoDAO{
            //CRUD
            //CRIAR * INSERIR
        function inserir ($produto){

            include __DIR__ . "/../conexao.php";
            $sql = "INSERT INTO produto (cod_usuario, cod_categoria, nome, marca, descricao, valor, promocao, estoque) VALUES (:cod_usuario, :cod_categoria, :nome, :marca, :descricao, :valor, :promocao, :estoque)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_usuario", $produto->getCodUsuario());
            $consulta->bindValue(":cod_categoria", $produto->getCod_categoria());
            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":marca", $produto->getMarca());
            $consulta->bindValue(":descricao", $produto->getDescricao());
            $consulta->bindValue(":valor", $produto->getValor());
            $consulta->bindValue(":promocao", $produto->getPromocao());
            $consulta->bindValue(":estoque", $produto-> getEstoque());
         
            if($consulta->execute()){
                return $conexao->lastInsertId();
            } else {
                return false;
            }
        }

        //READ * LER/LISTAR
        function listar(){
           include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM produto";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchALL();
        }

        function listarPorVendedor($cod_usuario){
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT p.*, c.nome AS categoria_nome, (SELECT foto FROM foto f WHERE f.cod_produto = p.cod_produto LIMIT 1) AS foto FROM produto p LEFT JOIN categoria c ON p.cod_categoria = c.cod_categoria WHERE p.cod_usuario = :cod_usuario";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_usuario", $cod_usuario);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Lista todos os produtos com uma foto e nome do vendedor
        function listarComFotos(){
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT p.*, c.nome AS categoria_nome, u.nome AS usuario_nome, (SELECT foto FROM foto f WHERE f.cod_produto = p.cod_produto LIMIT 1) AS foto FROM produto p LEFT JOIN categoria c ON p.cod_categoria = c.cod_categoria LEFT JOIN usuario u ON p.cod_usuario = u.cod_usuario";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Buscar produto por id com dados relacionados
        function buscarPorId($cod_produto){
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT p.*, c.nome AS categoria_nome, u.nome AS usuario_nome FROM produto p LEFT JOIN categoria c ON p.cod_categoria = c.cod_categoria LEFT JOIN usuario u ON p.cod_usuario = u.cod_usuario WHERE p.cod_produto = :cod_produto";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

                // UPDATE - ATUALIZAR
        function atualizar($produto){
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE produto SET nome=:nome, marca=:marca, descricao=:descricao, valor=:valor, promocao=:promocao, estoque=:estoque WHERE cod_produto = :cod_produto" ;
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $produto->getCod_produto());
            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":marca", $produto->getMarca());
            $consulta->bindValue(":descricao", $produto->getDescricao());
            $consulta->bindValue(":valor", $produto->getValor());
            $consulta->bindValue(":promocao", $produto->getPromocao());
            $consulta->bindValue(":estoque", $produto-> getEstoque());
        
            if($consulta->execute()){
                return true;
            } else {
                return false;
            }

        }

        // DELETE - APAGAR
        function apagar($cod_produto){
           include __DIR__ . "/../conexao.php";
           $sql = "DELETE FROM produto WHERE cod_produto=:cod_produto";
           $consulta = $conexao->prepare($sql);
           $consulta->bindValue(":cod_produto", $cod_produto);
           if($consulta->execute()){
                return true;
           } else {
                return false;
           }
        }
  
        function buscar($pesquisa){
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM produto WHERE nome LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
    
?>