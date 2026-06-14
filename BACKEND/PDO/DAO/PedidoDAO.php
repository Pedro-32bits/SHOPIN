<?php
    class PedidoDAO {

        // Create - Inserir um novo pedido
        function inserir($pedido) {
            include __DIR__ . "/../conexao.php";
            $sql = "INSERT INTO pedido (cod_pedido, cod_usuario, formaPag, preco, cupom, validacao, notaF) 
                    VALUES (:cod_pedido, :cod_usuario, :formaPag, :preco, :cupom, :validacao, :notaF)";
            
            $consulta = $conexao->prepare($sql); 
            $consulta->bindValue(":cod_pedido", $pedido->getCodPedido());
            $consulta->bindValue(":cod_usuario", $pedido->getCodUsuario());
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

        function buscarPorUsuario($cod_usuario) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT
                        p.*,
                        COALESCE(SUM(po.qnt), 0) AS total_itens,
                        COUNT(po.cod_produto) AS tipos_produto
                    FROM pedido p
                    LEFT JOIN possui po ON po.cod_pedido = p.cod_pedido
                    WHERE p.cod_usuario = :cod_usuario
                    GROUP BY p.cod_pedido
                    ORDER BY p.cod_pedido DESC";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_usuario", $cod_usuario);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        function buscarDetalhadoPorUsuario($cod_pedido, $cod_usuario) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM pedido WHERE cod_pedido = :cod_pedido AND cod_usuario = :cod_usuario";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_pedido", $cod_pedido);
            $consulta->bindValue(":cod_usuario", $cod_usuario);
            $consulta->execute();
            $pedido = $consulta->fetch(PDO::FETCH_ASSOC);

            if (!$pedido) {
                return null;
            }

            $sqlItens = "SELECT
                            po.qnt,
                            pr.cod_produto,
                            pr.nome,
                            pr.marca,
                            pr.valor,
                            pr.promocao,
                            u.nome AS vendedor_nome,
                            (SELECT foto FROM foto f WHERE f.cod_produto = pr.cod_produto LIMIT 1) AS foto
                        FROM possui po
                        INNER JOIN produto pr ON pr.cod_produto = po.cod_produto
                        LEFT JOIN usuario u ON u.cod_usuario = pr.cod_usuario
                        WHERE po.cod_pedido = :cod_pedido";
            $consultaItens = $conexao->prepare($sqlItens);
            $consultaItens->bindValue(":cod_pedido", $cod_pedido);
            $consultaItens->execute();
            $pedido['itens'] = $consultaItens->fetchAll(PDO::FETCH_ASSOC);

            return $pedido;
        }

        function resumoVendasPorVendedor($cod_usuario) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT
                        COALESCE(SUM(po.qnt), 0) AS total_vendas,
                        COALESCE(SUM(po.qnt * CASE WHEN pr.promocao IS NOT NULL AND pr.promocao > 0 THEN pr.promocao ELSE pr.valor END), 0) AS total_arrecadado
                    FROM possui po
                    INNER JOIN produto pr ON pr.cod_produto = po.cod_produto
                    INNER JOIN pedido p ON p.cod_pedido = po.cod_pedido
                    WHERE pr.cod_usuario = :cod_usuario
                      AND COALESCE(p.validacao, 0) = 1";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_usuario", $cod_usuario);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

        // Read - Listar todos os pedidos
        function listar() {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM pedido";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar dados do pedido
        function atualizar($pedido) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE pedido SET 
                    cod_usuario=:cod_usuario, 
                    formaPag=:formaPag, 
                    preco=:preco, 
                    cupom=:cupom, 
                    validacao=:validacao, 
                    notaF=:notaF 
                    WHERE cod_pedido = :cod";
            
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $pedido->getCodPedido());
            $consulta->bindValue(":cod_usuario", $pedido->getCodUsuario());
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
            include __DIR__ . "/../conexao.php";
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
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM pedido WHERE cod_pedido LIKE :pesquisa OR notaF LIKE :pesquisa";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 
    }
?>
