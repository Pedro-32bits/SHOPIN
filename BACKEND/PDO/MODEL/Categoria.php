<?php
    /*CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL*/ 

  class Categoria{
    private $cod_categoria;
    private $nome;

    public function getCod_categoria(){
        return $this  ->cod_categoria;
    }
    public function setCod_categoria($value){
        $this -> cod_categoria = $value;
    }

    public function getNome(){
        return $this -> nome;
    }
    public function setNome($value){
        $this -> nome = $value;
    }
  }


?>