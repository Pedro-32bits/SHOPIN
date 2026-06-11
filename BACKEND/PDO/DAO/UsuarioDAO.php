<?php
class UsuarioDAO
{
    //CREATE - INSERIR 
    function inserir($usuario){

        include __DIR__ .  "/../conexao.php";
        $sql = "INSERT INTO usuario (nome, email, senha, telefone, cpf,  cnpj, tipo, validacao, data_nascimento) VALUES (:nome, :email, :senha, :telefone, :cpf, :cnpj, :tipo, :validacao, :data_nascimento)";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $usuario->getNome());
        $consulta->bindValue(":email", $usuario->getEmail());
        $consulta->bindValue(":senha",  $usuario->getSenha());
        $consulta->bindValue(":telefone",  $usuario->getTelefone());
        $consulta->bindValue(":cpf", $usuario->getCpf());
        $consulta->bindValue(":cnpj", $usuario->getCnpj());
        $consulta->bindValue(":tipo", $usuario->getTipo());
        $consulta->bindValue(":validacao", $usuario->getValidacao());
        $consulta->bindValue("data_nascimento", $usuario->getDataNascimento());

        if ($consulta->execute()) {
            return $conexao->lastInsertId();
        } else {
            return false;
        }
    }
    //READ - LER
    function listar(){

        include __DIR__ . "/../conexao.php";
        $sql = "SELECT * FROM usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    //UPDATE - ATUALIZER
    function atualizar($usuario){

        include __DIR__ . "/../conexao.php";
        $sql =  "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, cpf = :cpf, cnpj = :cnpj, tipo = :tipo, validacao = :validacao, data_nascimento = :data_nascimento WHERE cod_usuario = :cod_usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $usuario->getNome());
        $consulta->bindValue(":email", $usuario->getEmail());
        $consulta->bindValue(":senha", $usuario->getSenha());
        $consulta->bindValue(":telefone", $usuario->getTelefone());
        $consulta->bindValue(":cpf", $usuario->getCpf());
        $consulta->bindValue(":cnpj", $usuario->getCnpj());
        $consulta->bindValue(":tipo", $usuario->getTipo());
        $consulta->bindValue(":validacao", $usuario->getValidacao());
        $consulta->bindValue(":data_nascimento", $usuario->getDataNascimento());
        $consulta->bindValue(":cod_usuario", $usuario->getCodUsuario());
        $consulta->execute();
    }

    //DELETE - APAGAR 
    function apagar($cod){

        include __DIR__ .  "/../conexao.php";
        $sql = "DELETE FROM usuario WHERE cod_usuario = :cod_usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod_usuario", $cod);
        $consulta->execute();
    }

    function buscar($cod){

        include __DIR__ .  "/../conexao.php";
        $sql = "SELECT * FROM usuario WHERE cod_usuario = :cod_usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod_usuario", $cod);
        $consulta->execute();
        return $consulta->fetch();
    }


    function logar($email, $senha){
         
        include __DIR__ . "/../conexao.php";;
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":email", $email);
        $consulta->bindValue(":senha", $senha);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }


    function tornarVendedor($cod_usuario){

        include __DIR__ . "/../conexao.php";
        $sql = "UPDATE usuario SET tipo = 'vendedor' WHERE cod_usuario = :cod_usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod_usuario", $cod_usuario);
        return $consulta->execute();

    }
}


?>