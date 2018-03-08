<?php 
 class modelMapper{
  public static function map(Model $model, array $properties){
	if (array_key_exists('id', $properties)){
	  $model->setid($properties['id']);
	}
	if (array_key_exists('tabela', $properties)){
	  $model->settabela($properties['tabela']);
	}
	if (array_key_exists('excluido', $properties)){
	  $model->setexcluido($properties['excluido']);
	}
	if (array_key_exists('criado', $properties)){
	  $model->setcriado($properties['criado']);
	}
	if (array_key_exists('codigo', $properties)){
	  $model->setcodigo($properties['codigo']);
	}
	if (array_key_exists('nota', $properties)){
	  $model->setnota($properties['nota']);
	}
	if (array_key_exists('descricao', $properties)){
	  $model->setdescricao($properties['descricao']);
	}
	if (array_key_exists('entrada', $properties)){
	  $model->setentrada($properties['entrada']);
	}
	if (array_key_exists('loja', $properties)){
	  $model->setloja($properties['loja']);
	}
  } 
 }