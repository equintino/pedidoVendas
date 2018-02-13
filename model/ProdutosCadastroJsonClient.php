<?php
include '../config/OmieAppAuth.php';
/**
 * @service ProdutosCadastroJsonClient
 * @author omie
 */
class ProdutosCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/produtos/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/produtos/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		$call=Array(
			"call"=>$method,
			"param"=>$param,
			"app_key"=>OMIE_APP_KEY,
			"app_secret"=>OMIE_APP_SECRET
		);
                //print_r((json_encode($call)));die;
		return @json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Incluir um produto.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Lista de produtos a serem cadastrados.
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function IncluirProduto($produto_servico_cadastro){
		return self::_Call('IncluirProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * Altera um produto já cadastrado.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Lista de produtos a serem cadastrados.
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function AlterarProduto($produto_servico_cadastro){
		return self::_Call('AlterarProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * Exclui um produto
	 *
	 * @param produto_servico_cadastro_chave $produto_servico_cadastro_chave Pesquisa de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function ExcluirProduto($produto_servico_cadastro_chave){
		return self::_Call('ExcluirProduto',Array(
			$produto_servico_cadastro_chave
		));
	}

	/**
	 * Consulta um produto.
	 *
	 * @param produto_servico_cadastro_chave $produto_servico_cadastro_chave Pesquisa de produtos
	 * @return produto_servico_cadastro Lista de produtos a serem cadastrados.
	 */
	public function ConsultarProduto($produto_servico_cadastro_chave){
		return self::_Call('ConsultarProduto',Array(
			$produto_servico_cadastro_chave
		));
	}

	/**
	 * Incluir produtos por lote.
	 *
	 * @param produto_servico_lote_request $produto_servico_lote_request Importação em Lote de produtos
	 * @return produto_servico_lote_response Resposta do processamento do lote de produto importados.
	 */
	public function IncluirProdutosPorLote($produto_servico_lote_request){
		return self::_Call('IncluirProdutosPorLote',Array(
			$produto_servico_lote_request
		));
	}

	/**
	 * Lista completa do cadastro de produtos
	 *
	 * @param produto_servico_list_request $produto_servico_list_request Lista os produtos cadastrados
	 * @return produto_servico_listfull_response Lista completa de produtos encontrados no omie.
	 */
	public function ListarProdutos($produto_servico_list_request){
		return self::_Call('ListarProdutos',Array(
			$produto_servico_list_request
		));
	}

	/**
	 * Lista os produtos cadastrados
	 *
	 * @param produto_servico_list_request $produto_servico_list_request Lista os produtos cadastrados
	 * @return produto_servico_list_response Lista de produtos encontrados no omie.
	 */
	public function ListarProdutosResumido($produto_servico_list_request){
		return self::_Call('ListarProdutosResumido',Array(
			$produto_servico_list_request
		));
	}

	/**
	 * Realiza a inclusão/alteração de produtos.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Lista de produtos a serem cadastrados.
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function UpsertProduto($produto_servico_cadastro){
		return self::_Call('UpsertProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * Inclui / Altera produtos por lote
	 *
	 * @param produto_servico_lote_request $produto_servico_lote_request Importação em Lote de produtos
	 * @return produto_servico_lote_response Resposta do processamento do lote de produto importados.
	 */
	public function UpsertProdutosPorLote($produto_servico_lote_request){
		return self::_Call('UpsertProdutosPorLote',Array(
			$produto_servico_lote_request
		));
	}
}

/**
 * Dados do IBPT
 *
 * @pw_element decimal $aliqFederal Carga tributária federal para os produtos nacionais
 * @pw_element decimal $aliqEstadual Carga tributária estadual
 * @pw_element decimal $aliqMunicipal Carga tributária municipal
 * @pw_element string $fonte Fonte
 * @pw_element string $chave Número da versão do arquivo
 * @pw_element string $versao Versão da Tabela IBPT.
 * @pw_element string $valido_de Tabela válilda a partir da data.
 * @pw_element string $valido_ate Tabela IBPT valida até a data.
 * @pw_complex dadosIbpt
 */
class dadosIbpt{
	/**
	 * Carga tributária federal para os produtos nacionais
	 *
	 * @var decimal
	 */
	public $aliqFederal;
	/**
	 * Carga tributária estadual
	 *
	 * @var decimal
	 */
	public $aliqEstadual;
	/**
	 * Carga tributária municipal
	 *
	 * @var decimal
	 */
	public $aliqMunicipal;
	/**
	 * Fonte
	 *
	 * @var string
	 */
	public $fonte;
	/**
	 * Número da versão do arquivo
	 *
	 * @var string
	 */
	public $chave;
	/**
	 * Versão da Tabela IBPT.
	 *
	 * @var string
	 */
	public $versao;
	/**
	 * Tabela válilda a partir da data.
	 *
	 * @var string
	 */
	public $valido_de;
	/**
	 * Tabela IBPT valida até a data.
	 *
	 * @var string
	 */
	public $valido_ate;
}

/**
 * Lista de produtos a serem cadastrados.
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
 * @pw_element string $codigo ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
 * @pw_element string $descricao Descrição para o Produto / Serviço
 * @pw_element string $ean GTIN (Global Trade Item Number)
 * @pw_element string $ncm Código da Nomenclatura Comum do Mercosul
 * @pw_element string $csosn_icms Código da Situação Tributária para Simples Nacional
 * @pw_element string $unidade Código da Unidade
 * @pw_element decimal $valor_unitario Valor unitário de Venda
 * @pw_element string $cst_icms CST do ICMS
 * @pw_element decimal $aliquota_icms Alíquota de ICMS&nbsp;
 * @pw_element decimal $red_base_icms Percentual de redução de base do ICMS
 * @pw_element decimal $aliquota_ibpt Mantido apenas para compatibilidade - Sempre retorna ZERO.
 * @pw_element string $tipoItem Código do Tipo do Item para o SPED
 * @pw_element string $cst_pis Código da Situação Tributária do PIS
 * @pw_element decimal $aliquota_pis Alíquota de PIS
 * @pw_element string $cst_cofins Código da Situação Tributária do PIS
 * @pw_element decimal $aliquota_cofins Alíquota de COFINS&nbsp;
 * @pw_element string $bloqueado Cadastro Bloqueado pela API
 * @pw_element string $importado_api Gerado pela API
 * @pw_element integer $codigo_familia Código da Familia
 * @pw_element string $codInt_familia Código de Integração da Familia
 * @pw_element string $descricao_familia Descrição da Familia&nbsp;
 * @pw_element string $inativo Indica se o cadstro de produto está inativo [S/N]
 * @pw_element dadosIbpt $dadosIbpt Dados do IBPT
 * @pw_element string $cest Código do CEST.
 * @pw_element string $cfop CFOP do Produto.
 * @pw_element decimal $peso_liq Peso Líquido (Kg)
 * @pw_element decimal $peso_bruto Peso Bruto (Kg)
 * @pw_element decimal $estoque_minimo Quantidade do Estoque Mínimo
 * @pw_element string $descr_detalhada Descrição Detalhada para o Produto
 * @pw_element string $obs_internas Observações Internas
 * @pw_element decimal $quantidade_estoque DEPRECATED
 * @pw_element recomendacoes_fiscais $recomendacoes_fiscais Recomendações Fiscais&nbsp;
 * @pw_complex produto_servico_cadastro
 */
class produto_servico_cadastro{
	/**
	 * Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição para o Produto / Serviço
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * GTIN (Global Trade Item Number)
	 *
	 * @var string
	 */
	public $ean;
	/**
	 * Código da Nomenclatura Comum do Mercosul
	 *
	 * @var string
	 */
	public $ncm;
	/**
	 * Código da Situação Tributária para Simples Nacional
	 *
	 * @var string
	 */
	public $csosn_icms;
	/**
	 * Código da Unidade
	 *
	 * @var string
	 */
	public $unidade;
	/**
	 * Valor unitário de Venda
	 *
	 * @var decimal
	 */
	public $valor_unitario;
	/**
	 * CST do ICMS
	 *
	 * @var string
	 */
	public $cst_icms;
	/**
	 * Alíquota de ICMS&nbsp;
	 *
	 * @var decimal
	 */
	public $aliquota_icms;
	/**
	 * Percentual de redução de base do ICMS
	 *
	 * @var decimal
	 */
	public $red_base_icms;
	/**
	 * Mantido apenas para compatibilidade - Sempre retorna ZERO.
	 *
	 * @var decimal
	 */
	public $aliquota_ibpt;
	/**
	 * Código do Tipo do Item para o SPED
	 *
	 * @var string
	 */
	public $tipoItem;
	/**
	 * Código da Situação Tributária do PIS
	 *
	 * @var string
	 */
	public $cst_pis;
	/**
	 * Alíquota de PIS
	 *
	 * @var decimal
	 */
	public $aliquota_pis;
	/**
	 * Código da Situação Tributária do PIS
	 *
	 * @var string
	 */
	public $cst_cofins;
	/**
	 * Alíquota de COFINS&nbsp;
	 *
	 * @var decimal
	 */
	public $aliquota_cofins;
	/**
	 * Cadastro Bloqueado pela API
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * Gerado pela API
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * Código da Familia
	 *
	 * @var integer
	 */
	public $codigo_familia;
	/**
	 * Código de Integração da Familia
	 *
	 * @var string
	 */
	public $codInt_familia;
	/**
	 * Descrição da Familia&nbsp;
	 *
	 * @var string
	 */
	public $descricao_familia;
	/**
	 * Indica se o cadstro de produto está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * Dados do IBPT
	 *
	 * @var dadosIbpt
	 */
	public $dadosIbpt;
	/**
	 * Código do CEST.
	 *
	 * @var string
	 */
	public $cest;
	/**
	 * CFOP do Produto.
	 *
	 * @var string
	 */
	public $cfop;
	/**
	 * Peso Líquido (Kg)
	 *
	 * @var decimal
	 */
	public $peso_liq;
	/**
	 * Peso Bruto (Kg)
	 *
	 * @var decimal
	 */
	public $peso_bruto;
	/**
	 * Quantidade do Estoque Mínimo
	 *
	 * @var decimal
	 */
	public $estoque_minimo;
	/**
	 * Descrição Detalhada para o Produto
	 *
	 * @var string
	 */
	public $descr_detalhada;
	/**
	 * Observações Internas
	 *
	 * @var string
	 */
	public $obs_internas;
	/**
	 * DEPRECATED
	 *
	 * @var decimal
	 */
	public $quantidade_estoque;
	/**
	 * Recomendações Fiscais&nbsp;
	 *
	 * @var recomendacoes_fiscais
	 */
	public $recomendacoes_fiscais;
}


/**
 * Recomendações Fiscais
 *
 * @pw_element string $origem_mercadoria Origem da Mercadoria.<BR>Preenchimento Opcional.<BR><BR>
 * @pw_element integer $id_preco_tabelado Preço tabelado (Pauta).<BR>Preenchimento Opcional.
 * @pw_element string $id_cest ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
 * @pw_element string $cupom_fiscal Este produto é vendido através de Cupom Fiscal ECF, SAT ou NFC-e (no PDV) ?<BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
 * @pw_complex recomendacoes_fiscais
 */
class recomendacoes_fiscais{
	/**
	 * Origem da Mercadoria.<BR>Preenchimento Opcional.<BR><BR>
	 *
	 * @var string
	 */
	public $origem_mercadoria;
	/**
	 * Preço tabelado (Pauta).<BR>Preenchimento Opcional.
	 *
	 * @var integer
	 */
	public $id_preco_tabelado;
	/**
	 * ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $id_cest;
	/**
	 * Este produto é vendido através de Cupom Fiscal ECF, SAT ou NFC-e (no PDV) ?<BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
	 *
	 * @var string
	 */
	public $cupom_fiscal;
}

/**
 * Pesquisa de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
 * @pw_element string $codigo ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
 * @pw_complex produto_servico_cadastro_chave
 */
class produto_servico_cadastro_chave{
	/**
	 * Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $codigo;
}

/**
 * Lista os produtos cadastrados
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_element string $filtrar_por_data_de Filtrar os registros a partir de uma data.
 * @pw_element string $filtrar_por_hora_de Filtrar a partir da hora.
 * @pw_element string $filtrar_por_data_ate Filtrar os registros até uma data.
 * @pw_element string $filtrar_por_hora_ate Filtrar até a hora.
 * @pw_element string $filtrar_apenas_inclusao Filtrar apenas os registros incluídos.
 * @pw_element string $filtrar_apenas_alteracao Filtrar apenas os registros alterados.
 * @pw_element string $filtrar_apenas_omiepdv Filtrar apenas produtos OmiePDV.<BR>O preenchimento desse campo é obrigatório e o seu padrão é "S".<BR>
 * @pw_element string $filtrar_apenas_familia Filtrar por Familia de Produto
 * @pw_element string $filtrar_apenas_tipo Código do Tipo do Item para o SPED
 * @pw_element string $filtrar_apenas_descricao Filtro pela descrição do produto.<BR>Para filtrar utilize:<BR>"TEXTO" - Para pesquisa exata.<BR>"TEXTO%" - Para pesquisa começando com.<BR>"%TEXTO" - Para pesquisa terminando com.<BR>"%TEXTO%" - Para pesquisa contendo.
 * @pw_element string $ordem_descrescente Deprecated
 * @pw_complex produto_servico_list_request
 */
class produto_servico_list_request{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. Padrão: Código.
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Se a lista será apresentada em ordem decrescente.
	 *
	 * @var string
	 */
	public $ordem_decrescente;
	/**
	 * Filtrar os registros a partir de uma data.
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Filtrar a partir da hora.
	 *
	 * @var string
	 */
	public $filtrar_por_hora_de;
	/**
	 * Filtrar os registros até uma data.
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtrar até a hora.
	 *
	 * @var string
	 */
	public $filtrar_por_hora_ate;
	/**
	 * Filtrar apenas os registros incluídos.
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtrar apenas os registros alterados.
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Filtrar apenas produtos OmiePDV.<BR>O preenchimento desse campo é obrigatório e o seu padrão é "S".<BR>
	 *
	 * @var string
	 */
	public $filtrar_apenas_omiepdv;
	/**
	 * Filtrar por Familia de Produto
	 *
	 * @var string
	 */
	public $filtrar_apenas_familia;
	/**
	 * Código do Tipo do Item para o SPED
	 *
	 * @var string
	 */
	public $filtrar_apenas_tipo;
	/**
	 * Filtro pela descrição do produto.<BR>Para filtrar utilize:<BR>"TEXTO" - Para pesquisa exata.<BR>"TEXTO%" - Para pesquisa começando com.<BR>"%TEXTO" - Para pesquisa terminando com.<BR>"%TEXTO%" - Para pesquisa contendo.
	 *
	 * @var string
	 */
	public $filtrar_apenas_descricao;
	/**
	 * Deprecated
	 *
	 * @var string
	 */
	public $ordem_descrescente;
}

/**
 * Lista de produtos encontrados no omie.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element produto_servico_resumidoArray $produto_servico_resumido Cadastro reduzido de produtos
 * @pw_complex produto_servico_list_response
 */
class produto_servico_list_response{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número total de páginas
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * total de registros encontrados
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Cadastro reduzido de produtos
	 *
	 * @var produto_servico_resumidoArray
	 */
	public $produto_servico_resumido;
}

/**
 * Cadastro reduzido de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
 * @pw_element string $codigo ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
 * @pw_element string $descricao Descrição para o Produto / Serviço
 * @pw_element decimal $valor_unitario Valor unitário de Venda
 * @pw_complex produto_servico_resumido
 */
class produto_servico_resumido{
	/**
	 * Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * ID do CEST (Código Especificador da Substituíção Tributária).<BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição para o Produto / Serviço
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Valor unitário de Venda
	 *
	 * @var decimal
	 */
	public $valor_unitario;
}


/**
 * Lista completa de produtos encontrados no omie.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element produto_servico_cadastroArray $produto_servico_cadastro Lista de produtos a serem cadastrados.
 * @pw_complex produto_servico_listfull_response
 */
class produto_servico_listfull_response{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número total de páginas
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * total de registros encontrados
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Lista de produtos a serem cadastrados.
	 *
	 * @var produto_servico_cadastroArray
	 */
	public $produto_servico_cadastro;
}

/**
 * Importação em Lote de produtos
 *
 * @pw_element integer $lote Número do lote
 * @pw_element produto_servico_cadastroArray $produto_servico_cadastro Lista de produtos a serem cadastrados.
 * @pw_complex produto_servico_lote_request
 */
class produto_servico_lote_request{
	/**
	 * Número do lote
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Lista de produtos a serem cadastrados.
	 *
	 * @var produto_servico_cadastroArray
	 */
	public $produto_servico_cadastro;
}

/**
 * Resposta do processamento do lote de produto importados.
 *
 * @pw_element integer $lote Número do lote
 * @pw_element string $codigo_status Código do status do processamento
 * @pw_element string $descricao_status Descrição do status do lote de processamento
 * @pw_complex produto_servico_lote_response
 */
class produto_servico_lote_response{
	/**
	 * Número do lote
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Código do status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do lote de processamento
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Status de retorno do cadastro de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
 * @pw_element string $codigo_status Código do status do processamento
 * @pw_element string $descricao_status Descrição do status do lote de processamento
 * @pw_complex produto_servico_status
 */
class produto_servico_status{
	/**
	 * Código do produto.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse código para identificar um produto via API, para obter uma melhor performance. <BR>Opcionalmente você pode informar o código de integração para localizar um produto através do campo "codigo_produto_integracao".
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>(Utilizado para integração via API)<BR>Esse código não aparece na tela do Omie.<BR>Utilize esse campo quando incluir um produto e desejar associar o código do produto do seu aplicativo com o código de produto gerado pelo Omie.<BR>O preenchimento desse campo é obrigatório na inclusão e opcional para os demais métodos.<BR>
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do status do processamento
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do lote de processamento
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
/*if (!class_exists('omie_fail')) {
class omie_fail{
	public $code;
	
	public $description;
	
	public $referer;
	
	public $fatal;
}
}*/