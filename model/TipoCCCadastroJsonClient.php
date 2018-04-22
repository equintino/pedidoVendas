<?php
/**
 * @service TipoCCCadastroJsonClient
 * @author omie
 */
class TipoCCCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/tipocc/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/tipocc/';

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
	 * Listar os tipos de contas correntes.
	 *
	 * @param tipoCCListarRequest $tipoCCListarRequest Solicitação da listagem de tipos de conta corrente.
	 * @return tipoCCListarResponse Resposta da solicitação da listagem de tipos de conta corrente.
	 */
	public function ListarTiposCC($tipoCCListarRequest){
		return self::_Call('ListarTiposCC',Array(
			$tipoCCListarRequest
		));
	}
}

/**
 * Lista os cadastros encontrados.
 *
 * @pw_element string $cCodigo Código do tipo de oportunidade.
 * @pw_element string $cDescricao Descrição do tipo de oportunidade.
 * @pw_element string $cGrupo Observação do tipo de oportunidade.
 * @pw_complex cadastros
 */
class cadastros{
	/**
	 * Código do tipo de oportunidade.
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Descrição do tipo de oportunidade.
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Observação do tipo de oportunidade.
	 *
	 * @var string
	 */
	public $cGrupo;
}


/**
 * Solicitação da listagem de tipos de conta corrente.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_complex tipoCCListarRequest
 */
class tipoCCListarRequest{
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
}

/**
 * Resposta da solicitação da listagem de tipos de conta corrente.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element cadastrosArray $cadastros Lista os cadastros encontrados.
 * @pw_complex tipoCCListarResponse
 */
class tipoCCListarResponse{
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
	 * Lista os cadastros encontrados.
	 *
	 * @var cadastrosArray
	 */
	public $cadastros;
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