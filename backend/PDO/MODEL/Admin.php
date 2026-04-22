<?php
/*CREATE TABLE `admin` (
  `cod_admin` int(11) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL
);*/

class Admin{

private $cod_admin;
private $login;
private $nome;
private $email;
private $senha;

    public function getCod_admin() {
		  return $this-> cod_admin;
		}
    public function setCod_admin($value){
        $this -> cod_admin =$value;
    }

    public function getLogin(){
        return $this -> login;
    }   
    public function setLogin($value){
        $this -> login = $value;
    }

    public function getNome(){
        return $this -> nome;
    }
    public function setNome($value){
        $this -> nome = $value;
    }

      public function getEmail() {
		  return $this-> email;
		}
    public function setEmail($value){
        $this -> email = $value;
    }

    public function getSenha() {
		return $this-> senha;
		}
    public function setSenha($value){
        $this -> senha = $value;
    }

    
    
    }   


?>