<<<<<<< HEAD
<?php  class modelMapper{ public static function map(Model$model,array$properties){if(array_key_exists('id',$properties)){$model->setid($properties['id']);}if(array_key_exists('tabela',$properties)){$model->settabela($properties['tabela']);}if(array_key_exists('excluido',$properties)){$model->setexcluido($properties['excluido']);}if(array_key_exists('criado',$properties)){$model->setcriado($properties['criado']);}if(array_key_exists('modificado',$properties)){$model->setmodificado($properties['modificado']);}if(array_key_exists('inscricao_suframa',$properties)){$model->setinscricao_suframa($properties['inscricao_suframa']);}if(array_key_exists('produtor_rural',$properties)){$model->setprodutor_rural($properties['produtor_rural']);}if(array_key_exists('recomendacao_atraso',$properties)){$model->setrecomendacao_atraso($properties['recomendacao_atraso']);}if(array_key_exists('logradouro',$properties)){$model->setlogradouro($properties['logradouro']);}if(array_key_exists('importado_api',$properties)){$model->setimportado_api($properties['importado_api']);}if(array_key_exists('bloqueado',$properties)){$model->setbloqueado($properties['bloqueado']);}if(array_key_exists('codInt',$properties)){$model->setcodInt($properties['codInt']);}if(array_key_exists('comissao',$properties)){$model->setcomissao($properties['comissao']);}if(array_key_exists('fatura_pedido',$properties)){$model->setfatura_pedido($properties['fatura_pedido']);}if(array_key_exists('visualiza_pedido',$properties)){$model->setvisualiza_pedido($properties['visualiza_pedido']);}if(array_key_exists('nome',$properties)){$model->setnome($properties['nome']);}if(array_key_exists('inativo',$properties)){$model->setinativo($properties['inativo']);}if(array_key_exists('codigo',$properties)){$model->setcodigo($properties['codigo']);}if(array_key_exists('bairro',$properties)){$model->setbairro($properties['bairro']);}if(array_key_exists('cep',$properties)){$model->setcep($properties['cep']);}if(array_key_exists('cidade',$properties)){$model->setcidade($properties['cidade']);}if(array_key_exists('cidade_ibge',$properties)){$model->setcidade_ibge($properties['cidade_ibge']);}if(array_key_exists('cnpj_cpf',$properties)){$model->setcnpj_cpf($properties['cnpj_cpf']);}if(array_key_exists('codigo_cliente_integracao',$properties)){$model->setcodigo_cliente_integracao($properties['codigo_cliente_integracao']);}if(array_key_exists('codigo_cliente_omie',$properties)){$model->setcodigo_cliente_omie($properties['codigo_cliente_omie']);}if(array_key_exists('codigo_pais',$properties)){$model->setcodigo_pais($properties['codigo_pais']);}if(array_key_exists('complemento',$properties)){$model->setcomplemento($properties['complemento']);}if(array_key_exists('contribuinte',$properties)){$model->setcontribuinte($properties['contribuinte']);}if(array_key_exists('endereco',$properties)){$model->setendereco($properties['endereco']);}if(array_key_exists('endereco_numero',$properties)){$model->setendereco_numero($properties['endereco_numero']);}if(array_key_exists('estado',$properties)){$model->setestado($properties['estado']);}if(array_key_exists('exterior',$properties)){$model->setexterior($properties['exterior']);}if(array_key_exists('cImpAPI',$properties)){$model->setcImpAPI($properties['cImpAPI']);}if(array_key_exists('dAlt',$properties)){$model->setdAlt($properties['dAlt']);}if(array_key_exists('dInc',$properties)){$model->setdInc($properties['dInc']);}if(array_key_exists('hAlt',$properties)){$model->sethAlt($properties['hAlt']);}if(array_key_exists('hInc',$properties)){$model->sethInc($properties['hInc']);}if(array_key_exists('uAlt',$properties)){$model->setuAlt($properties['uAlt']);}if(array_key_exists('uInc',$properties)){$model->setuInc($properties['uInc']);}if(array_key_exists('info',$properties)){$model->setinfo($properties['info']);}if(array_key_exists('inscricao_estadual',$properties)){$model->setinscricao_estadual($properties['inscricao_estadual']);}if(array_key_exists('inscricao_municipal',$properties)){$model->setinscricao_municipal($properties['inscricao_municipal']);}if(array_key_exists('nome_fantasia',$properties)){$model->setnome_fantasia($properties['nome_fantasia']);}if(array_key_exists('observacao',$properties)){$model->setobservacao($properties['observacao']);}if(array_key_exists('pessoa_fisica',$properties)){$model->setpessoa_fisica($properties['pessoa_fisica']);}if(array_key_exists('razao_social',$properties)){$model->setrazao_social($properties['razao_social']);}if(array_key_exists('tags',$properties)){$model->settags($properties['tags']);}if(array_key_exists('cod_API',$properties)){$model->setcod_API($properties['cod_API']);}if(array_key_exists('contato',$properties)){$model->setcontato($properties['contato']);}if(array_key_exists('optante_simples_nacional',$properties)){$model->setoptante_simples_nacional($properties['optante_simples_nacional']);}if(array_key_exists('telefone1_ddd',$properties)){$model->settelefone1_ddd($properties['telefone1_ddd']);}if(array_key_exists('telefone1_numero',$properties)){$model->settelefone1_numero($properties['telefone1_numero']);}if(array_key_exists('telefone2_ddd',$properties)){$model->settelefone2_ddd($properties['telefone2_ddd']);}if(array_key_exists('telefone2_numero',$properties)){$model->settelefone2_numero($properties['telefone2_numero']);}if(array_key_exists('fax_ddd',$properties)){$model->setfax_ddd($properties['fax_ddd']);}if(array_key_exists('fax_numero',$properties)){$model->setfax_numero($properties['fax_numero']);}if(array_key_exists('homepage',$properties)){$model->sethomepage($properties['homepage']);}if(array_key_exists('tipo_atividade',$properties)){$model->settipo_atividade($properties['tipo_atividade']);}if(array_key_exists('email',$properties)){$model->setemail($properties['email']);}if(array_key_exists('cnae',$properties)){$model->setcnae($properties['cnae']);}}}
=======
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
	if (array_key_exists('modificado', $properties)){
	  $model->setmodificado($properties['modificado']);
	}
	if (array_key_exists('inscricao_suframa', $properties)){
	  $model->setinscricao_suframa($properties['inscricao_suframa']);
	}
	if (array_key_exists('produtor_rural', $properties)){
	  $model->setprodutor_rural($properties['produtor_rural']);
	}
	if (array_key_exists('recomendacao_atraso', $properties)){
	  $model->setrecomendacao_atraso($properties['recomendacao_atraso']);
	}
	if (array_key_exists('logradouro', $properties)){
	  $model->setlogradouro($properties['logradouro']);
	}
	if (array_key_exists('importado_api', $properties)){
	  $model->setimportado_api($properties['importado_api']);
	}
	if (array_key_exists('bloqueado', $properties)){
	  $model->setbloqueado($properties['bloqueado']);
	}
	if (array_key_exists('codInt', $properties)){
	  $model->setcodInt($properties['codInt']);
	}
	if (array_key_exists('comissao', $properties)){
	  $model->setcomissao($properties['comissao']);
	}
	if (array_key_exists('fatura_pedido', $properties)){
	  $model->setfatura_pedido($properties['fatura_pedido']);
	}
	if (array_key_exists('visualiza_pedido', $properties)){
	  $model->setvisualiza_pedido($properties['visualiza_pedido']);
	}
	if (array_key_exists('nome', $properties)){
	  $model->setnome($properties['nome']);
	}
	if (array_key_exists('inativo', $properties)){
	  $model->setinativo($properties['inativo']);
	}
	if (array_key_exists('codigo', $properties)){
	  $model->setcodigo($properties['codigo']);
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
	if (array_key_exists('cImpAPI', $properties)){
	  $model->setcImpAPI($properties['cImpAPI']);
	}
	if (array_key_exists('dAlt', $properties)){
	  $model->setdAlt($properties['dAlt']);
	}
	if (array_key_exists('dInc', $properties)){
	  $model->setdInc($properties['dInc']);
	}
	if (array_key_exists('hAlt', $properties)){
	  $model->sethAlt($properties['hAlt']);
	}
	if (array_key_exists('hInc', $properties)){
	  $model->sethInc($properties['hInc']);
	}
	if (array_key_exists('uAlt', $properties)){
	  $model->setuAlt($properties['uAlt']);
	}
	if (array_key_exists('uInc', $properties)){
	  $model->setuInc($properties['uInc']);
	}
	if (array_key_exists('info', $properties)){
	  $model->setinfo($properties['info']);
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
	if (array_key_exists('tags', $properties)){
	  $model->settags($properties['tags']);
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
	if (array_key_exists('cod_API', $properties)){
	  $model->setcod_API($properties['cod_API']);
	}
	if (array_key_exists('contato', $properties)){
	  $model->setcontato($properties['contato']);
	}
	if (array_key_exists('optante_simples_nacional', $properties)){
	  $model->setoptante_simples_nacional($properties['optante_simples_nacional']);
	}
	if (array_key_exists('telefone2_ddd', $properties)){
	  $model->settelefone2_ddd($properties['telefone2_ddd']);
	}
	if (array_key_exists('telefone2_numero', $properties)){
	  $model->settelefone2_numero($properties['telefone2_numero']);
	}
	if (array_key_exists('fax_ddd', $properties)){
	  $model->setfax_ddd($properties['fax_ddd']);
	}
	if (array_key_exists('fax_numero', $properties)){
	  $model->setfax_numero($properties['fax_numero']);
	}
	if (array_key_exists('homepage', $properties)){
	  $model->sethomepage($properties['homepage']);
	}
	if (array_key_exists('observacao', $properties)){
	  $model->setobservacao($properties['observacao']);
	}
	if (array_key_exists('contribuinte', $properties)){
	  $model->setcontribuinte($properties['contribuinte']);
	}
  } 
 }
>>>>>>> parent of d09152e... clean
