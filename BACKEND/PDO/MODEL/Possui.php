<?php


class Possui {
    private $cod_pedido;
    private $cod_produto;
    private $qnt;
    private $avaliacao;
    private $resenha;
    private $data_avaliacao;

    public function getCodPedido() {
      return $this->cod_pedido; 
    }
    public function setCodPedido($value){
        $this->cod_pedido = $value; 
        }

    public function getCodProduto(){
      return $this->cod_produto; 
      }
    public function setCodProduto($value){ 
    $this->cod_produto = $value; 
    }

    public function getQnt(){
      return $this->qnt; 
      }
    public function setQnt($value) { 
      $this->qnt = $value; 
    }

    public function getAvaliacao() { 
      return $this->avaliacao; 
      }
    public function setAvaliacao($value ) { 
      $this->avaliacao = $value; 
    }
    public function getResenha() {
       return $this->resenha; 
       }
    public function setResenha($value) {
       $this->resenha = $value; 
       }

    public function getDataAvaliacao() { 
      return $this->data_avaliacao; 
      }
    public function setDataAvaliacao($value) { 
      $this->data_avaliacao = $value; 
    }
}
?>