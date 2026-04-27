<?
    class VendedorDAO{

        //Create - inserir 
        function inserir ($vendedor){
            include "../PDO/conexao.php";
            $sql = "INSERT INTO vendedor (nome, email, telefone, foto, senha, CPF, CNPJ) VALUES (:nome, :email, :telefone, :foto, :senha, :CPF, :CNPJ)";
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":nome", $vendedor->getNome());
            $consulta->bindValue(":email", $vendedor->getEmail());
            $consulta->bindValue(":telefone", $vendedor->getTelefone());
            $consulta->bindValue(":foto", $vendedor->getFoto());
            $consulta->bindValue(":senha", $vendedor->getSenha());
            $consulta->bindValue(":CPF", $vendedor->getCPF());
            $consulta->bindValue(":CNPJ", $vendedor->getCNPJ());
         
            if($consulta->execute()){
                return true;
            } else {
                return false;
            }
        }

        //Read - ler
        function listar(){
           include "../PDO/conexao.php";
            $sql = "SELECT * FROM vendedor";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchALL();
        }

        //Update - Atualizar
            function atualizar($vendedor){
                include "../PDO/conexao.php";
                $sql = "UPDATE vendedor SET nome=:nome, email=:email, telefone=:telefone, foto=:foto, senha=:senha, cpf=:cpf, cnpj=:cnpj WHERE cod = :cod";
                $consulta = $conexao->prepare($sql);
                $consulta->bindValue(":cod", $vendedor->getCod());
                $consulta->bindValue(":nome", $vendedor->getNome());
                $consulta->bindValue(":email", $vendedor->getEmail());
                $consulta->bindValue(":telefone", $vendedor->getTelefone());
                $consulta->bindValue(":foto", $vendedor->getFoto());
                $consulta->bindValue(":senha", $vendedor->getSenha());
                $consulta->bindValue(":cpf", $vendedor->getCpf());
                $consulta->bindValue(":cnpj", $vendedor->getCnpj());
            }

            //Delete - Apagar 
                function apagar ($cod){
                    include "../PDO/conexao.php";
                        $sql = "DELETE FROM   vendedor WHERE cod = :cod"; 
                        $consulta = $conexao -> prepare ($sql);
                        $consulta -> bindValue (":cod" , $cod);

                        if($consulta -> execute()){
                            return true ;
                        }else {
                            return false; 
                        }
                }

                //Logar 
                 function logar ($email, $senha, $nome ){
                    include "../PDO/conexao.php";
                    $sql = "SELECT * FROM vendedor WHERE (email = :email) AND (senha = :senha) AND (nome = :nome";
                    $consulta = $conexao -> prepare ($sql);
                    $consulta -> bindValue ( ":email" , $email);
                    $consulta -> bindValue (":senha", $senha);
                    $consulta -> bindValue (":nome" , $nome); 
                    $consulta -> execute ();
                    return $consulta -> fecth();
                 }

                 //Buscar
                 function buscar($pesquisa){
                    include "../PDO/conexao.php";
                    $sql = "SELECT * FROM vendedor WHERE nome LIKE :pesquisa";
                    $consulta = $conexao -> prepare($sql);
                    $consulta  -> bindValue (":pesquisa", "%".$pesquisa."%");
                    $consulta -> execute ();
                    return $consulta -> fetchAll(); 
                 } 
    }
?>