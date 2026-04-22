<?php

/*CREATE TABLE `foto` (
  `foto_PK` int(11) NOT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL*/
  
  class Foto{
    private $foto_PK;
    private $cod_produto;
    private $foto;

      public function getFoto_PK() {
		  return $this-> foto_PK;
		}
    public function setFoto_PK($value){
        $this -> foto_PK =$value;
    }

    public function getCod_produto(){
        return $this -> cod_produto;
    }   
    public function setCod_produto($value){
        $this -> cod_produto = $value;
    }

    public function getFoto(){
        return $this -> foto;
    }
    public function setFoto($value){
        $this -> foto = $value;
  }

  }