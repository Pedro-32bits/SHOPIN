<?php
    class ClienteDAO {

        // Create - Inserir 
        function inserir($cliente) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "INSERT INTO cliente (nome, email, senha, telefone, CPF, foto) VALUES (:nome, :email, :senha, :telefone, :CPF, :foto)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":nome", $cliente->getNome());
            $consulta->bindValue(":email", $cliente->getEmail());
            $consulta->bindValue(":senha", $cliente->getSenha());
            $consulta->bindValue(":telefone", $cliente->getTelefone());
            $consulta->bindValue(":CPF", $cliente->getCPF());
            $consulta->bindValue(":foto", $cliente->getFoto());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Read - Listar todos
        function listar() {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM cliente";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($cliente) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "UPDATE cliente SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, CPF=:CPF, foto=:foto WHERE cod_cliente = :cod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cliente->getCodCliente());
            $consulta->bindValue(":nome", $cliente->getNome());
            $consulta->bindValue(":email", $cliente->getEmail());
            $consulta->bindValue(":senha", $cliente->getSenha());
            $consulta->bindValue(":telefone", $cliente->getTelefone());
            $consulta->bindValue(":CPF", $cliente->getCPF());
            $consulta->bindValue(":foto", $cliente->getFoto());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar 
        function apagar($cod) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "DELETE FROM cliente WHERE cod_cliente = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Logar 
        function logar($email, $senha, $nome) {
            include "../BACKEND/PDO/conexao.php";
            // Corrigido o parêntese que faltava no modelo original
            $sql = "SELECT * FROM cliente WHERE (email = :email) AND (senha = :senha) AND (nome = :nome)";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":email", $email);
            $consulta->bindValue(":senha", $senha);
            $consulta->bindValue(":nome", $nome); 
            $consulta->execute();
            return $consulta->fetch();
        }

        // Buscar por nome
        function buscar($pesquisa) {
            include "../BACKEND/PDO/conexao.php";
            $sql = "SELECT * FROM cliente WHERE nome LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>