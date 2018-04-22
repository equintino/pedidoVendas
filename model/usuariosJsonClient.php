<?php
/**
 * @service usuariosJsonClient
 * @author omie
 */
class usuariosJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/crm/usuarios/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/crm/usuarios/';

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
	 * Usuários da oportunidade.
	 *
	 * @param uscrmListarRequest $uscrmListarRequest Solicitação da listagem de usuários / vendedores / prevendas.
	 * @return uscrmListarResponse Resposta da solicitação da listagem de usuários / vendedores / prevendas.
	 */
	public function ListarUsuarios($uscrmListarRequest){
		return self::_Call('ListarUsuarios',Array(
			$uscrmListarRequest
		));
	}
}

/**
 * Lista os cadastros encontrados.
 *
 * @pw_element integer $nCodigo Código do usuário / vendedor / prevenda.
 * @pw_element string $cNome Nome do usuário.
 * @pw_element string $cEmail Email do usuário.
 * @pw_element string $cTelefone Telefone do usuário.
 * @pw_element string $cCelular Celular do usuário.
 * @pw_complex cadastros
 */
class cadastros{
	/**
	 * Código do usuário / vendedor / prevenda.
	 *
	 * @var integer
	 */
	public $nCodigo;
	/**
	 * Nome do usuário.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Email do usuário.
	 *
	 * @var string
	 */
	public $cEmail;
	/**
	 * Telefone do usuário.
	 *
	 * @var string
	 */
	public $cTelefone;
	/**
	 * Celular do usuário.
	 *
	 * @var string
	 */
	public $cCelular;
}


/**
 * Solicitação da listagem de usuários / vendedores / prevendas.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_complex uscrmListarRequest
 */
class uscrmListarRequest{
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
 * Resposta da solicitação da listagem de usuários / vendedores / prevendas.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element cadastrosArray $cadastros Lista os cadastros encontrados.
 * @pw_complex uscrmListarResponse
 */
class uscrmListarResponse{
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