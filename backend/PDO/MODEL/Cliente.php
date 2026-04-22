<?php
/*CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `foto` varchar(255) DEFAULT <NULL></NULL>*/


  class Cliente{
    private $cod_cliente;
    private $email;
    private $senha;
    private $nome;
    private $CPF;
    private $telefone;
    private $foto;

    public function getCod_cliente(){
        return $this -> cod_cliente;
    }
    public function setCod_cliente($value){
        $this -> cod_cliente = $value;
    }

    public function setEmail() {
		  return $this-> email;
		}
    public function getEmail($value){
        $this -> email = $value;
    }

    public function setTelefone() {
		return $this-> telefone;
		}
    public function getTelefone($value){
        $this -> telefone = $value;
    }

    public function setFoto() {
		return $this-> foto;
		}    
    public function getfoto($value){
        $this -> foto = $value;
    }

     public function setSenha() {
		return $this-> senha;
		}
    public function getSenha($value){
        $this -> senha = $value;
    }

    public function setCPF() {
		return $this-> CPF;
		}

    public function getCPF($value){
        $this -> CPF = $value;
    }

    public function getNome (){
        return $this -> nome;
    }
    public function setNome ($value){
        $this -> nome = $value;
    }

  }

?>