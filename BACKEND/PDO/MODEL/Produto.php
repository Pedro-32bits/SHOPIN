<?php

class Produto {
    private $cod_produto;
    private $cod_usuario;
    private $cod_categoria;
    private $nome;
    private $marca;
    private $descricao;
    private $valor;
    private $promocao;
    private $estoque;
    private $vendidos;

    public function getCod_produto() {
        return $this->cod_produto;
    }
    public function setCod_produto($value) {
        $this->cod_produto = $value;
    }

    public function getCodUsuario() {
        return $this->cod_usuario;
    }
    public function setCodUsuario($value) {
        $this->cod_usuario = $value;
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

    public function getEstoque(){
        return $this -> estoque;
    }
    public function setEstoque($value){
        $this -> estoque = $value;
    }
    public function getVendidos(){
        return $this -> vendidos;
    }
    public function setVendidos($value){
        $this-> vendidos = $value;
    }
}
?>