<?php
/**
 * @service FormasPagVendasJsonClient
 * @author omie
 */
class FormasPagVendasJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/formaspagvendas/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/formaspagvendas/';

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
	 * Lista as formas de pagmento de vendas.
	 *
	 * @param venparListarRequest $venparListarRequest Solicitação da listagem de formas de pagamento de vendas.
	 * @return venparListarResponse Resposta da solicitação de formas de pagamento de vendas.
	 */
	public function ListarFormasPagVendas($venparListarRequest){
		return self::_Call('ListarFormasPagVendas',Array(
			$venparListarRequest
		));
	}
}

/**
 * Solicitação da listagem de formas de pagamento de vendas.
 *
 * @pw_element integer $pagina Número da página para resgatar os dados.
 * @pw_element integer $registros_por_pagina Número de registros a serem exibidos por página.<BR>Máximo 50.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_complex venparListarRequest
 */
class venparListarRequest{
	/**
	 * Número da página para resgatar os dados.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros a serem exibidos por página.<BR>Máximo 50.
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
 * Resposta da solicitação de formas de pagamento de vendas.
 *
 * @pw_element integer $pagina Número da página para resgatar os dados.
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros a serem exibidos por página.<BR>Máximo 50.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element cadastrosArray $cadastros Lista os CESTs encontrados.
 * @pw_complex venparListarResponse
 */
class venparListarResponse{
	/**
	 * Número da página para resgatar os dados.
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
	 * Número de registros a serem exibidos por página.<BR>Máximo 50.
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
	 * Lista os CESTs encontrados.
	 *
	 * @var cadastrosArray
	 */
	public $cadastros;
}

/**
 * Lista os CESTs encontrados.
 *
 * @pw_element string $cCodigo Código da forma de pagamento.
 * @pw_element integer $nQtdeParc Quantidade de parcelas.
 * @pw_element string $cDescricao Descrição da forma de pagamento.
 * @pw_complex cadastros
 */
class cadastros{
	/**
	 * Código da forma de pagamento.
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Quantidade de parcelas.
	 *
	 * @var integer
	 */
	public $nQtdeParc;
	/**
	 * Descrição da forma de pagamento.
	 *
	 * @var string
	 */
	public $cDescricao;
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