<?php
/*CREATE TABLE `logistica` (
  `cod_logistica` int(11) NOT NULL,
  `cod_pedido` varchar(50) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `frete` varchar(50) DEFAULT NULL,
  `local_produto` varchar(100) DEFAULT NULL,
  `status_entrega` varchar(50) DEFAULT <NULL></NULL>*/



class Logistica {

    private $cod_logistica;
    private $cod_pedido;    // Chave Estrangeira (FK)
    private $cod_vendedor;  // Chave Estrangeira (FK)
    private $frete;
    private $local_produto;
    private $status_entrega;


    public function getCodLogistica() {
        return $this->cod_logistica;
    }
    public function setCodLogistica($value) {
        $this->cod_logistica = $value;
    }


    public function getCodPedido() {
        return $this->cod_pedido;
    }
    public function setCodPedido($value) {
        $this->cod_pedido = $value;
    }


    public function getCodVendedor() {
        return $this->cod_vendedor;
    }
    public function setCodVendedor($value) {
        $this->cod_vendedor = $value;
    }


    public function getFrete() {
        return $this->frete;
    }
    public function setFrete($value) {
        $this->frete = $value;
    }

    
    public function getLocalProduto() {
        return $this->local_produto;
    }
    public function setLocalProduto($value) {
        $this->local_produto = $value;
    }


    public function getStatusEntrega() {
        return $this->status_entrega;
    }
    public function setStatusEntrega($value) {
        $this->status_entrega = $value;
    }
}
?>
  ?>