<?php

/*CREATE TABLE `foto` (
  `foto_cod` int(11) NOT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL*/
  
  class Foto{
    private $cod_foto;
    private $cod_produto;
    private $foto;

      public function getCod_foto() {
		  return $this-> cod_foto;
		}
    public function setCod_foto($value){
        $this -> cod_foto =$value;
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