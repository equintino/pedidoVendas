<?php
/**
 * @service BancosCadastroJsonClient
 * @author omie
 */
class BancosCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/bancos/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/bancos/';

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
	 * Consulta os dados de um banco específico.
	 *
	 * @param fin_bancos_cadastro_chave $fin_bancos_cadastro_chave Chave para pesquisa do cadastro de Bancos / Instituíções Financeiras.
	 * @return fin_banco_cadastro Cadastro de bancos / instituições financeiras.
	 */
	public function ConsultarBanco($fin_bancos_cadastro_chave){
		return self::_Call('ConsultarBanco',Array(
			$fin_bancos_cadastro_chave
		));
	}

	/**
	 * Exibe uma lista com os banco cadastrados.
	 *
	 * @param fin_bancos_list_request $fin_bancos_list_request Lista os bancos / instituíções financeiras cadastrados.
	 * @return fin_bancos_list_response Lista de produtos encontrados no omie.
	 */
	public function ListarBancos($fin_bancos_list_request){
		return self::_Call('ListarBancos',Array(
			$fin_bancos_list_request
		));
	}
}

/**
 * Cadastro de bancos / instituições financeiras.
 *
 * @pw_element string $codigo Código do Banco / Instituição Financeira
 * @pw_element string $nome Nome do Banco
 * @pw_element string $tipo Tipo da Conta Corrente (CB Conta Bancária, CX Caixinha, CC Cartão de Crédito ou CV Carteira Virtual)
 * @pw_complex fin_banco_cadastro
 */
class fin_banco_cadastro{
	/**
	 * Código do Banco / Instituição Financeira
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Nome do Banco
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Tipo da Conta Corrente (CB Conta Bancária, CX Caixinha, CC Cartão de Crédito ou CV Carteira Virtual)
	 *
	 * @var string
	 */
	public $tipo;
}


/**
 * Lista os bancos / instituíções financeiras cadastrados.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api DEPRECATED
 * @pw_element string $ordenar_por DEPRECATED
 * @pw_element string $ordem_descrescente DEPRECATED
 * @pw_complex fin_bancos_list_request
 */
class fin_bancos_list_request{
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
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * DEPRECATED
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
 * @pw_element fin_banco_cadastroArray $fin_banco_cadastro Cadastro de bancos / instituições financeiras.
 * @pw_complex fin_bancos_list_response
 */
class fin_bancos_list_response{
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
	 * Cadastro de bancos / instituições financeiras.
	 *
	 * @var fin_banco_cadastroArray
	 */
	public $fin_banco_cadastro;
}

/**
 * Chave para pesquisa do cadastro de Bancos / Instituíções Financeiras.
 *
 * @pw_element string $codigo Código do Banco / Instituição Financeira
 * @pw_complex fin_bancos_cadastro_chave
 */
class fin_bancos_cadastro_chave{
	/**
	 * Código do Banco / Instituição Financeira
	 *
	 * @var string
	 */
	public $codigo;
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