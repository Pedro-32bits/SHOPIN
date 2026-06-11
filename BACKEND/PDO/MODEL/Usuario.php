<?php
class Usuario {
    private $cod_usuario;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $cpf;
    private $cnpj;
    private $tipo;
    private $validacao;
    private $data_nascimento;

    // Getters and Setters

    public function getCodUsuario(){
        return $this -> cod_usuario;
    }
    public function setCodUsuario($value){
        $this -> cod_usuario = $value;
    }

    public function getNome(){
        return $this -> nome;
    }
    public function setNome($value){
        $this -> nome = $value;
    }

    public function getEmail(){
        return $this -> email;
    }
    public function setEmail($value){
        $this -> email = $value;
    }

    public function getSenha(){
        return $this -> senha;
    }
    public function setSenha($value){
        $this -> senha = $value;
    }

    public function getTelefone(){
        return $this -> telefone;
    }
    public function setTelefone($value){
        $this -> telefone = $value;
    }

    public function getCpf(){
        return $this -> cpf;
    }
    public function setCpf($value){
        $this -> cpf = $value;
    }

    public function getCnpj(){
        return $this -> cnpj;
    }
    public function setCnpj ($value){
        $this -> cnpj = $value;
    }

    public function getTipo(){
        return $this -> tipo;
    }
    public function setTipo($value){
        $this -> tipo = $value;
    }

    public function getValidacao(){
        return $this -> validacao;
    }
    public function setValidacao($value){
        $this -> validacao = $value;
    }

    public function getDataNascimento(){
        return $this -> data_nascimento;
    }
    public function setDataNascimento($value){
        $this -> data_nascimento = $value;
    }
}