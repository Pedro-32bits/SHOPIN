<?php
/*
CREATE TABLE `produto` (
  `cod_produto` int(11) NOT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `promocao` decimal(10,2) DEFAULT NULL
)
*/

class Produto {
    private $cod_produto;
    private $cod_vendedor;
    private $cod_categoria;
    private $nome;
    private $marca;
    private $descricao;
    private $valor;
    private $promocao;

    public function getCod_produto() {
        return $this->cod_produto;
    }
    public function setCod_produto($value) {
        $this->cod_produto = $value;
    }

    public function getCod_vendedor() {
        return $this->cod_vendedor;
    }
    public function setCod_vendedor($value) {
        $this->cod_vendedor = $value;
    }

    public function getCod_categoria() {
        return $this->cod_categoria;
    }
    public function setCod_categoria($value) {
        $this->cod_categoria = $value;
    }

    // NOME
    public function getNome() {
        return $this->nome;
    }
    public function setNome($value) {
        $this->nome = $value;
    }

    public function getMarca() {
        return $this->marca;
    }
    public function setMarca($value) {
        $this->marca = $value;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    public function setDescricao($value) {
        $this->descricao = $value;
    }

    public function getValor() {
        return $this->valor;
    }
    public function setValor($value) {
        $this->valor = $value;
    }

    public function getPromocao() {
        return $this->promocao;
    }
    public function setPromocao($value) {
        $this->promocao = $value;
    }
}
?>