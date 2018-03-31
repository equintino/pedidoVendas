<?php 
 class ProdutoMapper{
  public static function map(modelProduto $modelProduto, array $properties){
	if (array_key_exists('id', $properties)){
	  $modelProduto->setid($properties['id']);
	}
	if (array_key_exists('tabela', $properties)){
	  $modelProduto->settabela($properties['tabela']);
	}
	if (array_key_exists('excluido', $properties)){
	  $modelProduto->setexcluido($properties['excluido']);
	}
	if (array_key_exists('criado', $properties)){
	  $modelProduto->setcriado($properties['criado']);
	}
	if (array_key_exists('loja', $properties)){
	  $modelProduto->setloja($properties['loja']);
	}
	if (array_key_exists('videos', $properties)){
	  $modelProduto->setvideos($properties['videos']);
	}
	if (array_key_exists('aliquota_cofins', $properties)){
	  $modelProduto->setaliquota_cofins($properties['aliquota_cofins']);
	}
	if (array_key_exists('aliquota_ibpt', $properties)){
	  $modelProduto->setaliquota_ibpt($properties['aliquota_ibpt']);
	}
	if (array_key_exists('aliquota_icms', $properties)){
	  $modelProduto->setaliquota_icms($properties['aliquota_icms']);
	}
	if (array_key_exists('aliquota_pis', $properties)){
	  $modelProduto->setaliquota_pis($properties['aliquota_pis']);
	}
	if (array_key_exists('altura', $properties)){
	  $modelProduto->setaltura($properties['altura']);
	}
	if (array_key_exists('bloqueado', $properties)){
	  $modelProduto->setbloqueado($properties['bloqueado']);
	}
	if (array_key_exists('cest', $properties)){
	  $modelProduto->setcest($properties['cest']);
	}
	if (array_key_exists('cfop', $properties)){
	  $modelProduto->setcfop($properties['cfop']);
	}
	if (array_key_exists('codInt_familia', $properties)){
	  $modelProduto->setcodInt_familia($properties['codInt_familia']);
	}
	if (array_key_exists('codigo', $properties)){
	  $modelProduto->setcodigo($properties['codigo']);
	}
	if (array_key_exists('codigo_familia', $properties)){
	  $modelProduto->setcodigo_familia($properties['codigo_familia']);
	}
	if (array_key_exists('codigo_produto', $properties)){
	  $modelProduto->setcodigo_produto($properties['codigo_produto']);
	}
	if (array_key_exists('codigo_produto_integracao', $properties)){
	  $modelProduto->setcodigo_produto_integracao($properties['codigo_produto_integracao']);
	}
	if (array_key_exists('csosn_icms', $properties)){
	  $modelProduto->setcsosn_icms($properties['csosn_icms']);
	}
	if (array_key_exists('cst_cofins', $properties)){
	  $modelProduto->setcst_cofins($properties['cst_cofins']);
	}
	if (array_key_exists('cst_icms', $properties)){
	  $modelProduto->setcst_icms($properties['cst_icms']);
	}
	if (array_key_exists('cst_pis', $properties)){
	  $modelProduto->setcst_pis($properties['cst_pis']);
	}
	if (array_key_exists('dadosIbpt', $properties)){
	  $modelProduto->setdadosIbpt($properties['dadosIbpt']);
	}
	if (array_key_exists('aliqEstadual', $properties)){
	  $modelProduto->setaliqEstadual($properties['aliqEstadual']);
	}
	if (array_key_exists('aliqFederal', $properties)){
	  $modelProduto->setaliqFederal($properties['aliqFederal']);
	}
	if (array_key_exists('aliqMunicipal', $properties)){
	  $modelProduto->setaliqMunicipal($properties['aliqMunicipal']);
	}
	if (array_key_exists('chave', $properties)){
	  $modelProduto->setchave($properties['chave']);
	}
	if (array_key_exists('fonte', $properties)){
	  $modelProduto->setfonte($properties['fonte']);
	}
	if (array_key_exists('valido_ate', $properties)){
	  $modelProduto->setvalido_ate($properties['valido_ate']);
	}
	if (array_key_exists('valido_de', $properties)){
	  $modelProduto->setvalido_de($properties['valido_de']);
	}
	if (array_key_exists('versao', $properties)){
	  $modelProduto->setversao($properties['versao']);
	}
	if (array_key_exists('descr_detalhada', $properties)){
	  $modelProduto->setdescr_detalhada($properties['descr_detalhada']);
	}
	if (array_key_exists('descricao', $properties)){
	  $modelProduto->setdescricao($properties['descricao']);
	}
	if (array_key_exists('descricao_familia', $properties)){
	  $modelProduto->setdescricao_familia($properties['descricao_familia']);
	}
	if (array_key_exists('dias_crossdocking', $properties)){
	  $modelProduto->setdias_crossdocking($properties['dias_crossdocking']);
	}
	if (array_key_exists('dias_garantia', $properties)){
	  $modelProduto->setdias_garantia($properties['dias_garantia']);
	}
	if (array_key_exists('ean', $properties)){
	  $modelProduto->setean($properties['ean']);
	}
	if (array_key_exists('estoque_minimo', $properties)){
	  $modelProduto->setestoque_minimo($properties['estoque_minimo']);
	}
	if (array_key_exists('imagens', $properties)){
	  $modelProduto->setimagens($properties['imagens']);
	}
	if (array_key_exists('url_imagem', $properties)){
	  $modelProduto->seturl_imagem($properties['url_imagem']);
	}
	if (array_key_exists('importado_api', $properties)){
	  $modelProduto->setimportado_api($properties['importado_api']);
	}
	if (array_key_exists('inativo', $properties)){
	  $modelProduto->setinativo($properties['inativo']);
	}
	if (array_key_exists('largura', $properties)){
	  $modelProduto->setlargura($properties['largura']);
	}
	if (array_key_exists('marca', $properties)){
	  $modelProduto->setmarca($properties['marca']);
	}
	if (array_key_exists('ncm', $properties)){
	  $modelProduto->setncm($properties['ncm']);
	}
	if (array_key_exists('obs_internas', $properties)){
	  $modelProduto->setobs_internas($properties['obs_internas']);
	}
	if (array_key_exists('peso_bruto', $properties)){
	  $modelProduto->setpeso_bruto($properties['peso_bruto']);
	}
	if (array_key_exists('peso_liq', $properties)){
	  $modelProduto->setpeso_liq($properties['peso_liq']);
	}
	if (array_key_exists('profundidade', $properties)){
	  $modelProduto->setprofundidade($properties['profundidade']);
	}
	if (array_key_exists('quantidade_estoque', $properties)){
	  $modelProduto->setquantidade_estoque($properties['quantidade_estoque']);
	}
	if (array_key_exists('recomendacoes_fiscais', $properties)){
	  $modelProduto->setrecomendacoes_fiscais($properties['recomendacoes_fiscais']);
	}
	if (array_key_exists('cupom_fiscal', $properties)){
	  $modelProduto->setcupom_fiscal($properties['cupom_fiscal']);
	}
	if (array_key_exists('id_cest', $properties)){
	  $modelProduto->setid_cest($properties['id_cest']);
	}
	if (array_key_exists('id_preco_tabelado', $properties)){
	  $modelProduto->setid_preco_tabelado($properties['id_preco_tabelado']);
	}
	if (array_key_exists('market_place', $properties)){
	  $modelProduto->setmarket_place($properties['market_place']);
	}
	if (array_key_exists('origem_mercadoria', $properties)){
	  $modelProduto->setorigem_mercadoria($properties['origem_mercadoria']);
	}
	if (array_key_exists('red_base_icms', $properties)){
	  $modelProduto->setred_base_icms($properties['red_base_icms']);
	}
	if (array_key_exists('tipoItem', $properties)){
	  $modelProduto->settipoItem($properties['tipoItem']);
	}
	if (array_key_exists('unidade', $properties)){
	  $modelProduto->setunidade($properties['unidade']);
	}
	if (array_key_exists('valor_unitario', $properties)){
	  $modelProduto->setvalor_unitario($properties['valor_unitario']);
	}
  } 
 }