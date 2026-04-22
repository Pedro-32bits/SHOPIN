<?php
class Vendedor {

 private $cod;
 private $email;
 private $telefone;
 private $foto;
 private $senha; 
 private $validacao;
 private $CPF;
 private $CNPJ;
 private $nome;

    public function getCod() {
		  return $this-> cod;
		}
    public function setCod($value){
        $this -> cod =$value;
    }
    
    public function getEmail() {
		  return $this-> email;
		}
    public function setEmail($value){
        $this -> email = $value;
    }

    public function getTelefone() {
		return $this-> telefone;
		}
    public function setTelefone($value){
        $this -> telefone = $value;
    }

    public function getFoto() {
		return $this-> foto;
		}    
    public function setfoto($value){
        $this -> foto = $value;
    }


     public function getSenha() {
		return $this-> senha;
		}
    public function setSenha($value){
        $this -> senha = $value;

    }

    public function getValidacao() {
		return $this-> foto;
		}    
    public function setValidacao($value){
        $this -> foto = $value;
    }
    
    public function getCPF() {
		return $this-> CPF;
		}

    public function setCPF($value){
        $this -> CPF = $value;
    }
    
    public function getCNPJ() {
		return $this-> CNPJ;
		}
    public function setCNPJ($value){
        $this -> CNPJ = $value;
    
}

    public function getNome() {
		return $this-> nome;
		}
    public function setNome($value){
        $this -> nome = $value;
    
}
}
?>