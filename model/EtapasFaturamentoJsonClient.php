<?php
/**
 * @service EtapasFaturamentoJsonClient
 * @author omie
 */
class EtapasFaturamentoJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/etapafat/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/etapafat/';

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
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Lista as etapas do faturamento
	 *
	 * @param etaproListarRequest $etaproListarRequest Solicitação da listagem de etapas do processo de faturamento.
	 * @return etaproListarResponse Resposta da solicitação de etapas do processo de faturamento.
	 */
	public function ListarEtapasFaturamento($etaproListarRequest){
		return self::_Call('ListarEtapasFaturamento',Array(
			$etaproListarRequest
		));
	}
}

/**
 * Solicitação da listagem de etapas do processo de faturamento.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_complex etaproListarRequest
 */
class etaproListarRequest{
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
}

/**
 * Resposta da solicitação de etapas do processo de faturamento.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element cadastrosArray $cadastros Lista de etapas do processo de faturamento.
 * @pw_complex etaproListarResponse
 */
class etaproListarResponse{
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
	 * Lista de etapas do processo de faturamento.
	 *
	 * @var cadastrosArray
	 */
	public $cadastros;
}

/**
 * Lista de etapas do processo de faturamento.
 *
 * @pw_element string $cCodOperacao Código da Operação de faturamento.
 * @pw_element string $cDescOperacao Descrição da Operação de faturamento.
 * @pw_element etapasArray $etapas Lista de etapas
 * @pw_complex cadastros
 */
class cadastrosEtapa{
	/**
	 * Código da Operação de faturamento.
	 *
	 * @var string
	 */
	public $cCodOperacao;
	/**
	 * Descrição da Operação de faturamento.
	 *
	 * @var string
	 */
	public $cDescOperacao;
	/**
	 * Lista de etapas
	 *
	 * @var etapasArray
	 */
	public $etapas;
}


/**
 * Lista de etapas
 *
 * @pw_element string $cCodigo Código da etapa do processo de faturamento.
 * @pw_element string $cDescricao Descrição da etapa do processo de faturamento.
 * @pw_element string $cDescrPadrao Descrição padrão da etapa do processo de faturamento.
 * @pw_complex etapas
 */
class etapas{
	/**
	 * Código da etapa do processo de faturamento.
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Descrição da etapa do processo de faturamento.
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Descrição padrão da etapa do processo de faturamento.
	 *
	 * @var string
	 */
	public $cDescrPadrao;
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
if (!class_exists('omie_fail')) {
class omie_fail{
	/**
	 * Codigo do erro
	 *
	 * @var integer
	 */
	public $code;
	/**
	 * Descricao do erro
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Origem do erro
	 *
	 * @var string
	 */
	public $referer;
	/**
	 * Indica se eh um erro fatal
	 *
	 * @var boolean
	 */
	public $fatal;
}
}