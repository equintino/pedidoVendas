<?php 
 class ModelSearchCriteria{
   private $id;
               public function getid(){
                return $this->id;
              }
              public function setid($id){
                  $this->id=$id;
                  return $this;
              }
   private $tabela;
               public function gettabela(){
                return $this->tabela;
              }
              public function settabela($tabela){
                  $this->tabela=$tabela;
                  return $this;
              }
   private $excluido;
               public function getexcluido(){
                return $this->excluido;
              }
              public function setexcluido($excluido){
                  $this->excluido=$excluido;
                  return $this;
              }
   private $criado;
               public function getcriado(){
                return $this->criado;
              }
              public function setcriado($criado){
                  $this->criado=$criado;
                  return $this;
              }
   private $codigo;
               public function getcodigo(){
                return $this->codigo;
              }
              public function setcodigo($codigo){
                  $this->codigo = $codigo;
                  return $this;
              }
   private $nota;
               public function getnota(){
                return $this->nota;
              }
              public function setnota($nota){
                  $this->nota = $nota;
                  return $this;
              }
   private $descricao;
               public function getdescricao(){
                return $this->descricao;
              }
              public function setdescricao($descricao){
                  $this->descricao = $descricao;
                  return $this;
              }
   private $entrada;
               public function getentrada(){
                return $this->entrada;
              }
              public function setentrada($entrada){
                  $this->entrada = $entrada;
                  return $this;
              }
   private $loja;
               public function getloja(){
                return $this->loja;
              }
              public function setloja($loja){
                  $this->loja = $loja;
                  return $this;
              }
}