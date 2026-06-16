<?php
    class PossuiDAO {

        // Create - Inserir item no pedido
        function inserir($possui) {
            include __DIR__ . "/../conexao.php";
            $sql = "INSERT INTO possui (cod_pedido, cod_produto, qnt, avaliacao, resenha, data_avaliacao) VALUES (:cod_pedido, :cod_produto, :qnt, :avaliacao, :resenha, :data_avaliacao)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $possui->getCodPedido());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());
            $consulta->bindValue(":data_avaliacao", $possui->getDataAvaliacao());
         
            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        function listar() {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM possui";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // CORRIGIDO: Alterado de cod_possui para cod_pedido para bater com a sua classe Possui.php
        function atualizar($possui) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE possui SET qnt=:qnt, avaliacao=:avaliacao, resenha=:resenha, data_avaliacao=:data_avaliacao WHERE cod_pedido = :cod_pedido AND cod_produto = :cod_produto";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $possui->getCodPedido());
            $consulta->bindValue(":cod_produto", $possui->getCodProduto());
            $consulta->bindValue(":qnt", $possui->getQnt());
            $consulta->bindValue(":avaliacao", $possui->getAvaliacao());
            $consulta->bindValue(":resenha", $possui->getResenha());
            $consulta->bindValue(":data_avaliacao", $possui->getDataAvaliacao());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        function apagar($cod_pedido, $cod_produto) {
            include __DIR__ . "/../conexao.php";
            $sql = "DELETE FROM possui WHERE cod_pedido = :cod_pedido AND cod_produto = :cod_produto"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->bindValue(":cod_produto", $cod_produto);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar itens de um pedido específico
        function buscarPorPedido($cod_pedido) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM possui WHERE cod_pedido = :cod_pedido";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 

        // --- NOVOS MÉTODOS PARA SISTEMA DE RESENHAS ---

        // Buscar todas as resenhas preenchidas de um produto específico (trazendo o nome do usuário)
        function buscarPorProduto($cod_produto) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT po.*, u.nome AS usuario_nome 
                    FROM possui po 
                    LEFT JOIN pedido pe ON po.cod_pedido = pe.cod_pedido 
                    LEFT JOIN usuario u ON pe.cod_usuario = u.cod_usuario 
                    WHERE po.cod_produto = :cod_produto AND po.resenha IS NOT NULL AND po.resenha != ''
                    ORDER BY data_avaliacao DESC";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        // Verificar se o usuário logado possui esse produto em algum pedido para poder avaliar
        function buscarPedidoDoUsuarioProduto($cod_usuario, $cod_produto) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT po.cod_pedido FROM possui po 
                    JOIN pedido pe ON po.cod_pedido = pe.cod_pedido 
                    WHERE pe.cod_usuario = :cod_usuario AND po.cod_produto = :cod_produto 
                    LIMIT 1";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_usuario", $cod_usuario);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

        // Salvar/Atualizar a resenha e nota de um pedido
        function salvarResenha($cod_pedido, $cod_produto, $avaliacao, $resenha) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE possui 
                    SET avaliacao = :avaliacao, resenha = :resenha, data_avaliacao = NOW() 
                    WHERE cod_pedido = :cod_pedido AND cod_produto = :cod_produto";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->bindValue(":avaliacao", $avaliacao);
            $consulta->bindValue(":resenha", $resenha);
            return $consulta->execute();
        }
    }
?>