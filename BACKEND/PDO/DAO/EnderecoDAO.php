<?php
class EnderecoDAO
{

    // Create - Inserir 
    function inserir($endereco)
    {
        include __DIR__ . "/../conexao.php";
        $sql = "INSERT INTO endereco (cod_usuario, CEP, rua, bairro, ponto_referencia, num_casa) 
                    VALUES (:cod_usuario, :CEP, :rua, :bairro, :ponto_referencia, :num_casa)";

        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod_usuario", $endereco->getCodUsuario());
        $consulta->bindValue(":CEP", $endereco->getCEP());
        $consulta->bindValue(":rua", $endereco->getRua());
        $consulta->bindValue(":bairro", $endereco->getBairro());
        $consulta->bindValue(":ponto_referencia", $endereco->getPonto_Referencia());
        $consulta->bindValue(":num_casa", $endereco->getNum_Casa());

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Read - Listar todos
    function listar()
    {
        include "../BACKEND/PDO/conexao.php";
        $sql = "SELECT * FROM endereco";
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    // Update - Atualizar
    function atualizar($endereco)
    {
        include "../BACKEND/PDO/conexao.php";
        $sql = "UPDATE endereco SET 
                    cod_usuario=:cod_usuario, CEP=:CEP,  rua=:rua,  bairro=:bairro,  ponto_referencia=:ponto_referencia,  num_casa=:num_casa WHERE cod_endereco = :cod_endereco";

        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod", $endereco->getCodEndereco());
        $consulta->bindValue(":cod_usuario", $endereco->getCodUsuario());
        $consulta->bindValue(":CEP", $endereco->getCEP());
        $consulta->bindValue(":rua", $endereco->getRua());
        $consulta->bindValue(":bairro", $endereco->getBairro());
        $consulta->bindValue(":ponto_referencia", $endereco->getPonto_Referencia());
        $consulta->bindValue(":num_casa", $endereco->getNum_Casa());

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete - Apagar 
    function apagar($cod)
    {
        include "../BACKEND/PDO/conexao.php";
        $sql = "DELETE FROM endereco WHERE cod_endereco = :cod_endereco";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod", $cod);

        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Buscar por CEP ou Rua (Pesquisa adaptada)
    function buscar($pesquisa)
    {
        include "../BACKEND/PDO/conexao.php";
        $sql = "SELECT * FROM endereco WHERE rua LIKE :pesquisa OR CEP LIKE :pesquisa";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":pesquisa", "%" . $pesquisa . "%");
        $consulta->execute();
        return $consulta->fetchAll();
    }
    // Procura endereço do Cliente
    function buscarPorCliente($cod_usuario)
    {
        include __DIR__ . "/../conexao.php";
        $sql = "SELECT * FROM endereco WHERE cod_usuario = :cod_usuario";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":cod_usuario", $cod_usuario);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC); // Devolve o endereço ou false se não achar
    }
}
