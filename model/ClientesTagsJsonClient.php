<?php
/**
 * @service ClientesTagsJsonClient
 * @author omie
 */
class ClientesTagsJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/clientetag/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/clientetag/';

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
	 * Associa tags a um cliente.
	 *
	 * @param cTagIncluirRequest $cTagIncluirRequest Solicitação de inclusão de tags de um cliente.
	 * @return cTagIncluirResponse Resposta da solicitação de inclusão de tags de um cliente.
	 */
	public function IncluirTags($cTagIncluirRequest){
		return self::_Call('IncluirTags',Array(
			$cTagIncluirRequest
		));
	}

	/**
	 * Remove tags associadas a um cliente.
	 *
	 * @param cTagExcluirRequest $cTagExcluirRequest Solicitação de exclusão de tags de um cliente.
	 * @return cTagExcluirResponse Resposta da solicitação de exclusão de tags de um cliente.
	 */
	public function ExcluirTags($cTagExcluirRequest){
		return self::_Call('ExcluirTags',Array(
			$cTagExcluirRequest
		));
	}

	/**
	 * Remove todas as tags associadas a um cliente.
	 *
	 * @param cTagExcluirTodasRequest $cTagExcluirTodasRequest Solicitação de exclusão de todas as tags de um cliente.
	 * @return cTagExcluirTodasResponse Resposta da solicitação de exclusão de todas as  tags de um cliente.
	 */
	public function ExcluirTodas($cTagExcluirTodasRequest){
		return self::_Call('ExcluirTodas',Array(
			$cTagExcluirTodasRequest
		));
	}

	/**
	 * Lista as tags de um determinado cliente.
	 *
	 * @param cTagListarRequest $cTagListarRequest Solicitação da listagem de tags de um cliente.
	 * @return cTagListarResponse Resposta da solicitação da listagem de tags de um cliente.
	 */
	public function ListarTags($cTagListarRequest){
		return self::_Call('ListarTags',Array(
			$cTagListarRequest
		));
	}
}

/**
 * Solicitação de exclusão de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element tags $tags Tags do Cliente ou Fornecedor.
 * @pw_complex cTagExcluirRequest
 */
class cTagExcluirRequest{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Tags do Cliente ou Fornecedor.
	 *
	 * @var tags
	 */
	public $tags;
}

/**
 * Tags do Cliente ou Fornecedor.
 *
 * @pw_element string $tag Tag do Cliente ou Fornecedor
 * @pw_complex tags
 */
class tags{
	/**
	 * Tag do Cliente ou Fornecedor
	 *
	 * @var string
	 */
	public $tag;
}

/**
 * Resposta da solicitação de exclusão de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element string $cCodStatus Código do Status.
 * @pw_element string $cDesStatus Descrição do Status.
 * @pw_complex cTagExcluirResponse
 */
class cTagExcluirResponse{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Código do Status.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do Status.
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Solicitação de exclusão de todas as tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_complex cTagExcluirTodasRequest
 */
class cTagExcluirTodasRequest{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
}

/**
 * Resposta da solicitação de exclusão de todas as  tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element string $cCodStatus Código do Status.
 * @pw_element string $cDesStatus Descrição do Status.
 * @pw_complex cTagExcluirTodasResponse
 */
class cTagExcluirTodasResponse{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Código do Status.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do Status.
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Solicitação de inclusão de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element tags $tags Tags do Cliente ou Fornecedor.
 * @pw_complex cTagIncluirRequest
 */
class cTagIncluirRequest{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Tags do Cliente ou Fornecedor.
	 *
	 * @var tags
	 */
	public $tags;
}

/**
 * Resposta da solicitação de inclusão de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element string $cCodStatus Código do Status.
 * @pw_element string $cDesStatus Descrição do Status.
 * @pw_element tagsListaArray $tagsLista Tags do Cliente ou Fornecedor.
 * @pw_complex cTagIncluirResponse
 */
class cTagIncluirResponse{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Código do Status.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do Status.
	 *
	 * @var string
	 */
	public $cDesStatus;
	/**
	 * Tags do Cliente ou Fornecedor.
	 *
	 * @var tagsListaArray
	 */
	public $tagsLista;
}

/**
 * Tags do Cliente ou Fornecedor.
 *
 * @pw_element string $tag Tag do Cliente ou Fornecedor
 * @pw_element integer $nCodTag Código da Tag.<BR><BR>Criada pelo Omie no momento da inclusão.
 * @pw_complex tagsLista
 */
class tagsLista{
	/**
	 * Tag do Cliente ou Fornecedor
	 *
	 * @var string
	 */
	public $tag;
	/**
	 * Código da Tag.<BR><BR>Criada pelo Omie no momento da inclusão.
	 *
	 * @var integer
	 */
	public $nCodTag;
}


/**
 * Solicitação da listagem de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_complex cTagListarRequest
 */
class cTagListarRequest{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
}

/**
 * Resposta da solicitação da listagem de tags de um cliente.
 *
 * @pw_element integer $nCodCliente Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
 * @pw_element string $cCodIntCliente Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
 * @pw_element tagsListaArray $tagsLista Tags do Cliente ou Fornecedor.
 * @pw_complex cTagListarResponse
 */
class cTagListarResponse{
	/**
	 * Código do cliente.<BR>(Código interno utilizado apenas na API, não aparece na tela).<BR>
	 *
	 * @var integer
	 */
	public $nCodCliente;
	/**
	 * Código de integração do cliente.<BR>(Utilizado para integração via API, não aparece na tela)
	 *
	 * @var string
	 */
	public $cCodIntCliente;
	/**
	 * Tags do Cliente ou Fornecedor.
	 *
	 * @var tagsListaArray
	 */
	public $tagsLista;
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