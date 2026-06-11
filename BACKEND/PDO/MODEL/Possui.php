<?php
/*
CREATE TABLE `possui` (
  `cod_pedido` varchar(50) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `qnt` int(11) DEFAULT NULL,
  `avaliacao` decimal(3,2) DEFAULT NULL,
  `resenha` varchar(250) DEFAULT NULL,
  `data_avaliacao` date DEFAULT NULL
)
*/

class Possui {
    private $cod_pedido;
    private $cod_produto;
    private $qnt;
    private $avaliacao;
    private $resenha;
    private $data_avaliacao;

    public function getCodPedido() { return $this->cod_pedido; }
    public function setCodPedido($v) { $this->cod_pedido = $v; }

    public function getCodProduto() { return $this->cod_produto; }
    public function setCodProduto($v) { $this->cod_produto = $v; }

    public function getQnt() { return $this->qnt; }
    public function setQnt($v) { $this->qnt = $v; }

    public function getAvaliacao() { return $this->avaliacao; }
    public function setAvaliacao($v) { $this->avaliacao = $v; }

    public function getResenha() { return $this->resenha; }
    public function setResenha($v) { $this->resenha = $v; }

    public function getDataAvaliacao() { return $this->data_avaliacao; }
    public function setDataAvaliacao($v) { $this->data_avaliacao = $v; }
}
?>