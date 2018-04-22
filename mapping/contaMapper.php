<?php 
 class contaMapper{
  public static function map(conta $conta, array $properties){
	if (array_key_exists('id', $properties)){
	  $conta->setid($properties['id']);
	}
	if (array_key_exists('tabela', $properties)){
	  $conta->settabela($properties['tabela']);
	}
	if (array_key_exists('excluido', $properties)){
	  $conta->setexcluido($properties['excluido']);
	}
	if (array_key_exists('criado', $properties)){
	  $conta->setcriado($properties['criado']);
	}
	if (array_key_exists('bol_instr1', $properties)){
	  $conta->setbol_instr1($properties['bol_instr1']);
	}
	if (array_key_exists('bol_sn', $properties)){
	  $conta->setbol_sn($properties['bol_sn']);
	}
	if (array_key_exists('cobr_sn', $properties)){
	  $conta->setcobr_sn($properties['cobr_sn']);
	}
	if (array_key_exists('codigo_agencia', $properties)){
	  $conta->setcodigo_agencia($properties['codigo_agencia']);
	}
	if (array_key_exists('codigo_banco', $properties)){
	  $conta->setcodigo_banco($properties['codigo_banco']);
	}
	if (array_key_exists('data_alt', $properties)){
	  $conta->setdata_alt($properties['data_alt']);
	}
	if (array_key_exists('data_inc', $properties)){
	  $conta->setdata_inc($properties['data_inc']);
	}
	if (array_key_exists('descricao', $properties)){
	  $conta->setdescricao($properties['descricao']);
	}
	if (array_key_exists('dias_rcomp', $properties)){
	  $conta->setdias_rcomp($properties['dias_rcomp']);
	}
	if (array_key_exists('hora_alt', $properties)){
	  $conta->sethora_alt($properties['hora_alt']);
	}
	if (array_key_exists('hora_inc', $properties)){
	  $conta->sethora_inc($properties['hora_inc']);
	}
	if (array_key_exists('nCodCC', $properties)){
	  $conta->setnCodCC($properties['nCodCC']);
	}
	if (array_key_exists('nao_fluxo', $properties)){
	  $conta->setnao_fluxo($properties['nao_fluxo']);
	}
	if (array_key_exists('nao_resumo', $properties)){
	  $conta->setnao_resumo($properties['nao_resumo']);
	}
	if (array_key_exists('numero_conta_corrente', $properties)){
	  $conta->setnumero_conta_corrente($properties['numero_conta_corrente']);
	}
	if (array_key_exists('pdv_categoria', $properties)){
	  $conta->setpdv_categoria($properties['pdv_categoria']);
	}
	if (array_key_exists('pdv_cod_adm', $properties)){
	  $conta->setpdv_cod_adm($properties['pdv_cod_adm']);
	}
	if (array_key_exists('pdv_dias_venc', $properties)){
	  $conta->setpdv_dias_venc($properties['pdv_dias_venc']);
	}
	if (array_key_exists('pdv_enviar', $properties)){
	  $conta->setpdv_enviar($properties['pdv_enviar']);
	}
	if (array_key_exists('pdv_limite_pacelas', $properties)){
	  $conta->setpdv_limite_pacelas($properties['pdv_limite_pacelas']);
	}
	if (array_key_exists('pdv_num_parcelas', $properties)){
	  $conta->setpdv_num_parcelas($properties['pdv_num_parcelas']);
	}
	if (array_key_exists('pdv_sincr_analitica', $properties)){
	  $conta->setpdv_sincr_analitica($properties['pdv_sincr_analitica']);
	}
	if (array_key_exists('pdv_taxa_adm', $properties)){
	  $conta->setpdv_taxa_adm($properties['pdv_taxa_adm']);
	}
	if (array_key_exists('pdv_taxa_loja', $properties)){
	  $conta->setpdv_taxa_loja($properties['pdv_taxa_loja']);
	}
	if (array_key_exists('pdv_tipo_tef', $properties)){
	  $conta->setpdv_tipo_tef($properties['pdv_tipo_tef']);
	}
	if (array_key_exists('per_juros', $properties)){
	  $conta->setper_juros($properties['per_juros']);
	}
	if (array_key_exists('per_multa', $properties)){
	  $conta->setper_multa($properties['per_multa']);
	}
	if (array_key_exists('saldo_inicial', $properties)){
	  $conta->setsaldo_inicial($properties['saldo_inicial']);
	}
	if (array_key_exists('tipo', $properties)){
	  $conta->settipo($properties['tipo']);
	}
	if (array_key_exists('tipo_conta_corrente', $properties)){
	  $conta->settipo_conta_corrente($properties['tipo_conta_corrente']);
	}
	if (array_key_exists('user_alt', $properties)){
	  $conta->setuser_alt($properties['user_alt']);
	}
	if (array_key_exists('user_inc', $properties)){
	  $conta->setuser_inc($properties['user_inc']);
	}
	if (array_key_exists('valor_limite', $properties)){
	  $conta->setvalor_limite($properties['valor_limite']);
	}
	if (array_key_exists('OMIE_APP_KEY', $properties)){
	  $conta->setOMIE_APP_KEY($properties['OMIE_APP_KEY']);
	}
  } 
 }