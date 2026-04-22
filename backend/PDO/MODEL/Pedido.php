<?php
/*
CREATE TABLE `pedido` (
  `cod_pedido` varchar(50) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `formaPag` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `cupom` varchar(50) DEFAULT NULL,
  `validacao` tinyint(1) DEFAULT NULL,
  `notaF` varchar(50) DEFAULT NULL
)
*/

class Pedido {
    private $cod_pedido;
    private $cod_cliente;
    private $formaPag;
    private $preco;
    private $cupom;
    private $validacao;
    private $notaF;

    // COD_PEDIDO
    public function getCod_pedido() {
        return $this->cod_pedido;
    }
    public function setCod_pedido($value) {
        $this->cod_pedido = $value;
    }

    // COD_CLIENTE (Chave Estrangeira)
    public function getCod_cliente() {
        return $this->cod_cliente;
    }
    public function setCod_cliente($value) {
        $this->cod_cliente = $value;
    }

    // FORMAPAG
    public function getFormaPag() {
        return $this->formaPag;
    }
    public function setFormaPag($value) {
        $this->formaPag = $value;
    }

    // PRECO
    public function getPreco() {
        return $this->preco;
    }
    public function setPreco($value) {
        $this->preco = $value;
    }

    // CUPOM
    public function getCupom() {
        return $this->cupom;
    }
    public function setCupom($value) {
        $this->cupom = $value;
    }

    // VALIDACAO (Tratado como Booleano)
    public function getValidacao() {
        return $this->validacao;
    }
    public function setValidacao($value) {
        $this->validacao = $value;
    }

    // NOTAF (Nota Fiscal)
    public function getNotaF() {
        return $this->notaF;
    }
    public function setNotaF($value) {
        $this->notaF = $value;
    }
}
?>