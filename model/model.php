<?php 
 class Model{
	 private $id; 
	 public function getid(){
		 return $this->id; 
 	}
	 public function setid($id){
		$this->id=$id;
 	}
	 private $tabela; 
	 public function gettabela(){
		 return $this->tabela; 
 	}
	 public function settabela($tabela){
		$this->tabela=$tabela;
 	}
	 private $excluido; 
	 public function getexcluido(){
		 return $this->excluido; 
 	}
	 public function setexcluido($excluido){
		$this->excluido=$excluido;
 	}
	 private $criado; 
	 public function getcriado(){
		 return $this->criado; 
 	}
	 public function setcriado($criado){
		$this->criado=$criado;
 	}
 private $codigo;
 public function getcodigo(){
	return $this->codigo;
 }
 public function setcodigo($codigo ){
	$this->codigo=$codigo;
 }
 private $nota;
 public function getnota(){
	return $this->nota;
 }
 public function setnota($nota ){
	$this->nota=$nota;
 }
 private $descricao;
 public function getdescricao(){
	return $this->descricao;
 }
 public function setdescricao($descricao ){
	$this->descricao=$descricao;
 }
 private $entrada;
 public function getentrada(){
	return $this->entrada;
 }
 public function setentrada($entrada ){
	$this->entrada=$entrada;
 }
 private $loja;
 public function getloja(){
	return $this->loja;
 }
 public function setloja($loja ){
	$this->loja=$loja;
 }
 }