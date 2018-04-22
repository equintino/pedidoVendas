<?php
/**
 * @service TiposDocumentoCadastroJsonClient
 * @author omie
 */
class TiposDocumentoCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/tiposdoc/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/tiposdoc/';

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
	 * Consulta um tipo de documento por código
	 *
	 * @param tipo_documento_consultar $tipo_documento_consultar Pesquisa um tipo de documento por código
	 * @return tipo_documento_cadastro Cadastro de tipos de documentos
	 */
	public function ConsultarTipoDocumento($tipo_documento_consultar){
		return self::_Call('ConsultarTipoDocumento',Array(
			$tipo_documento_consultar
		));
	}

	/**
	 * Pesquisa o tipo de documento
	 *
	 * @param tipo_documento_pesquisa_request $tipo_documento_pesquisa_request Pesquisa do tipo de documento
	 * @return tipo_documento_pesquisa_response Resposta da pesquisa,
	 */
	public function PesquisarTipoDocumento($tipo_documento_pesquisa_request){
		return self::_Call('PesquisarTipoDocumento',Array(
			$tipo_documento_pesquisa_request
		));
	}
}

/**
 * Cadastro de tipos de documentos
 *
 * @pw_element string $codigo Código para o Tipo de Documento
 * @pw_element string $descricao Descrição para o Tipo de Documento
 * @pw_complex tipo_documento_cadastro
 */
class tipo_documento_cadastro{
	/**
	 * Código para o Tipo de Documento
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição para o Tipo de Documento
	 *
	 * @var string
	 */
	public $descricao;
}


/**
 * Pesquisa um tipo de documento por código
 *
 * @pw_element string $codigo Código para o Tipo de Documento
 * @pw_complex tipo_documento_consultar
 */
class tipo_documento_consultar{
	/**
	 * Código para o Tipo de Documento
	 *
	 * @var string
	 */
	public $codigo;
}

/**
 * Resposta da pesquisa,
 *
 * @pw_element tipo_documento_cadastroArray $tipo_documento_cadastro Cadastro de tipos de documentos
 * @pw_complex tipo_documento_pesquisa_response
 */
class tipo_documento_pesquisa_response{
	/**
	 * Cadastro de tipos de documentos
	 *
	 * @var tipo_documento_cadastroArray
	 */
	public $tipo_documento_cadastro;
}

/**
 * Pesquisa do tipo de documento
 *
 * @pw_element string $codigo Código para o Tipo de Documento
 * @pw_complex tipo_documento_pesquisa_request
 */
class tipo_documento_pesquisa_request{
	/**
	 * Código para o Tipo de Documento
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