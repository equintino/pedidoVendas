<?php 
 class modelMapper{
  public static function map(Model $model, array $properties){
      //print_r($properties);die;
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
	if (array_key_exists('cod_API', $properties)){
	  $model->setcod_API($properties['cod_API']);
	}
	if (array_key_exists('bairro', $properties)){
	  $model->setbairro($properties['bairro']);
	}
	if (array_key_exists('cep', $properties)){
	  $model->setcep($properties['cep']);
	}
	if (array_key_exists('cidade', $properties)){
	  $model->setcidade($properties['cidade']);
	}
	if (array_key_exists('cidade_ibge', $properties)){
	  $model->setcidade_ibge($properties['cidade_ibge']);
	}
	if (array_key_exists('cnae', $properties)){
	  $model->setcnae($properties['cnae']);
	}
	if (array_key_exists('cnpj_cpf', $properties)){
	  $model->setcnpj_cpf($properties['cnpj_cpf']);
	}
	if (array_key_exists('codigo_cliente_integracao', $properties)){
	  $model->setcodigo_cliente_integracao($properties['codigo_cliente_integracao']);
	}
	if (array_key_exists('codigo_cliente_omie', $properties)){
	  $model->setcodigo_cliente_omie($properties['codigo_cliente_omie']);
	}
	if (array_key_exists('codigo_pais', $properties)){
	  $model->setcodigo_pais($properties['codigo_pais']);
	}
	if (array_key_exists('complemento', $properties)){
	  $model->setcomplemento($properties['complemento']);
	}
	if (array_key_exists('email', $properties)){
	  $model->setemail($properties['email']);
	}
	if (array_key_exists('endereco', $properties)){
	  $model->setendereco($properties['endereco']);
	}
	if (array_key_exists('endereco_numero', $properties)){
	  $model->setendereco_numero($properties['endereco_numero']);
	}
	if (array_key_exists('estado', $properties)){
	  $model->setestado($properties['estado']);
	}
	if (array_key_exists('exterior', $properties)){
	  $model->setexterior($properties['exterior']);
	}
	if (array_key_exists('inscricao_estadual', $properties)){
	  $model->setinscricao_estadual($properties['inscricao_estadual']);
	}
	if (array_key_exists('inscricao_municipal', $properties)){
	  $model->setinscricao_municipal($properties['inscricao_municipal']);
	}
	if (array_key_exists('nome_fantasia', $properties)){
	  $model->setnome_fantasia($properties['nome_fantasia']);
	}
	if (array_key_exists('pessoa_fisica', $properties)){
	  $model->setpessoa_fisica($properties['pessoa_fisica']);
	}
	if (array_key_exists('razao_social', $properties)){
	  $model->setrazao_social($properties['razao_social']);
	}
	if (array_key_exists('telefone1_ddd', $properties)){
	  $model->settelefone1_ddd($properties['telefone1_ddd']);
	}
	if (array_key_exists('telefone1_numero', $properties)){
	  $model->settelefone1_numero($properties['telefone1_numero']);
	}
	if (array_key_exists('tipo_atividade', $properties)){
	  $model->settipo_atividade($properties['tipo_atividade']);
	}
  } 
 }