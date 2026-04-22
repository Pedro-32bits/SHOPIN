<?php
/*
CREATE TABLE `endereco` (
  `cod_endereco` int(11) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `ponto_referencia` varchar(100) DEFAULT NULL,
  `num_casa` varchar(10) DEFAULT NULL 
*/

class Endereco {
    private $cod_endereco;
    private $cod_cliente;
    private $cod_vendedor;
    private $CEP;
    private $rua;
    private $bairro;
    private $ponto_referencia;
    private $num_casa;

    
    public function getCod_endereco() {
        return $this->cod_endereco;
    }
    public function setCod_endereco($value) {
        $this->cod_endereco = $value;
    }

    public function getCod_cliente() {
        return $this->cod_cliente;
    }
    public function setCod_cliente($value) {
        $this->cod_cliente = $value;
    }
    
    public function getCod_vendedor() {
        return $this->cod_vendedor;
    }
    public function setCod_vendedor($value) {
        $this->cod_vendedor = $value;
    }

    public function getCEP() {
        return $this->CEP;
    }
    public function setCEP($value) {
        $this->CEP = $value;
    }

    public function getRua() {
        return $this->rua;
    }
    public function setRua($value) {
        $this->rua = $value;
    }

    public function getBairro() {
        return $this->bairro;
    }
    public function setBairro($value) {
        $this->bairro = $value;
    }

    public function getPonto_referencia() {
        return $this->ponto_referencia;
    }
    public function setPonto_referencia($value) {
        $this->ponto_referencia = $value;
    }

    public function getNum_casa() {
        return $this->num_casa;
    }
    public function setNum_casa($value) {
        $this->num_casa = $value;
    }
}
?>