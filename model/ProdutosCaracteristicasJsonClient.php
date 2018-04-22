<?php
/**
 * @service ProdutosCaracteristicasJsonClient
 * @author omie
 */
class ProdutosCaracteristicasJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/prodcaract/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/prodcaract/';

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
		return @json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Inclui uma característica a um produto.
	 *
	 * @param prcIncluirCaractRequest $prcIncluirCaractRequest Inclui uma característica para um produto.
	 * @return prcIncluirCaractResponse Resposta da solicitação de inclusão de uma característica para um produto.
	 */
	public function IncluirCaractProduto($prcIncluirCaractRequest){
		return self::_Call('IncluirCaractProduto',Array(
			$prcIncluirCaractRequest
		));
	}

	/**
	 * Altera a característica de um produto.
	 *
	 * @param prcAlterarCaractRequest $prcAlterarCaractRequest Altera uma característica para um produto.
	 * @return prcAlterarCaractResponse Resposta da solicitação de alteração de uma característica para um produto.
	 */
	public function AlterarCaractProduto($prcAlterarCaractRequest){
		return self::_Call('AlterarCaractProduto',Array(
			$prcAlterarCaractRequest
		));
	}

	/**
	 * Excluir um característica de um produto.
	 *
	 * @param prcExcluirCaractRequest $prcExcluirCaractRequest Exclui uma característica de um produto.
	 * @return prcExcluirCaractResponse Resposta da solicitação de exclusão da característica de um produto.
	 */
	public function ExcluirCaractProduto($prcExcluirCaractRequest){
		return self::_Call('ExcluirCaractProduto',Array(
			$prcExcluirCaractRequest
		));
	}

	/**
	 * Consultar uma característica de um produto.
	 *
	 * @param prcConsultarCaractRequest $prcConsultarCaractRequest Consulta uma característica de um produto.
	 * @return prcConsultarCaractResponse Resposta da solicitação de consulta da característica de um produto.
	 */
	public function ConsultarCaractProduto($prcConsultarCaractRequest){
		return self::_Call('ConsultarCaractProduto',Array(
			$prcConsultarCaractRequest
		));
	}

	/**
	 * Lista as características de um produto.
	 *
	 * @param prcListarCaractRequest $prcListarCaractRequest Listagem de características de um produto.
	 * @return prcListarCaractResponse Resposta da solicitação de listagem das características de um produto.
	 */
	public function ListarCaractProduto($prcListarCaractRequest){
		return self::_Call('ListarCaractProduto',Array(
			$prcListarCaractRequest
		));
	}
}

/**
 * Informações complemetares da característica.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hInc Hora da Inclusão.<BR>No formato hh:mm:ss.
 * @pw_element string $uInc Usuário da Inclusão.
 * @pw_element string $dAlt Data da Alteração.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hAlt Hora da Alteração.<BR>No formato hh:mm:ss.
 * @pw_element string $uAlt Usuário da Alteração.
 * @pw_element string $cImpAPI Importado pela API (S/N).
 * @pw_complex info
 */
class info_caracteristica{
	/**
	 * Data da Inclusão.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Listagem de características de um produto.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $cOrdenarPor Ordem os resultados da página por:<BR>CODIGO - Código do Característica.<BR>CODINT - Código de Integração da Característica.<BR>NOME - Nome da Característica.
 * @pw_element string $cOrdemDecrescente Indica se a ordem de exibição é Decrescente caso seja informado "S".
 * @pw_element string $dDtIncDe Data de inclusão inicial.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtIncAte Data de inclusão final.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtAltDe Data de alteração inicial.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtAltAte Data de alteração final.<BR>No formato dd/mm/aaaa.
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_complex prcListarCaractRequest
 */
class prcListarCaractRequest{
	/**
	 * Número da página resgatada.
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $nRegPorPagina;
	/**
	 * Ordem os resultados da página por:<BR>CODIGO - Código do Característica.<BR>CODINT - Código de Integração da Característica.<BR>NOME - Nome da Característica.
	 *
	 * @var string
	 */
	public $cOrdenarPor;
	/**
	 * Indica se a ordem de exibição é Decrescente caso seja informado "S".
	 *
	 * @var string
	 */
	public $cOrdemDecrescente;
	/**
	 * Data de inclusão inicial.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtIncDe;
	/**
	 * Data de inclusão final.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtIncAte;
	/**
	 * Data de alteração inicial.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtAltDe;
	/**
	 * Data de alteração final.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtAltAte;
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
}

/**
 * Resposta da solicitação de listagem das características de um produto.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nTotPaginas Número total de páginas encontradas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros Número total de registros encontrados.
 * @pw_element listaCaracteristicasArray $listaCaracteristicas Lista de características de produto.
 * @pw_complex prcListarCaractResponse
 */
class prcListarCaractResponse{
	/**
	 * Número da página resgatada.
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Número total de páginas encontradas.
	 *
	 * @var integer
	 */
	public $nTotPaginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $nRegistros;
	/**
	 * Número total de registros encontrados.
	 *
	 * @var integer
	 */
	public $nTotRegistros;
	/**
	 * Lista de características de produto.
	 *
	 * @var listaCaracteristicasArray
	 */
	public $listaCaracteristicas;
}

/**
 * Lista de características de produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNomeCaract Nome da característica.
 * @pw_element string $cConteudo Conteúdo da característica.
 * @pw_element string $cExibirItemNF Exibir esta característica no item da NF-e emitida (S/N).
 * @pw_element string $cExibirItemPedido Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
 * @pw_element info $info Informações complemetares da característica.<BR>
 * @pw_complex listaCaracteristicas
 */
class listaCaracteristicas{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Nome da característica.
	 *
	 * @var string
	 */
	public $cNomeCaract;
	/**
	 * Conteúdo da característica.
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Exibir esta característica no item da NF-e emitida (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemNF;
	/**
	 * Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemPedido;
	/**
	 * Informações complemetares da característica.<BR>
	 *
	 * @var info
	 */
	public $info;
}


/**
 * Inclui uma característica para um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cConteudo Conteúdo da característica.
 * @pw_element string $cExibirItemNF Exibir esta característica no item da NF-e emitida (S/N).
 * @pw_element string $cExibirItemPedido Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
 * @pw_complex prcIncluirCaractRequest
 */
class prcIncluirCaractRequest{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Conteúdo da característica.
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Exibir esta característica no item da NF-e emitida (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemNF;
	/**
	 * Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemPedido;
}

/**
 * Resposta da solicitação de inclusão de uma característica para um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex prcIncluirCaractResponse
 */
class prcIncluirCaractResponse{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Altera uma característica para um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cConteudo Conteúdo da característica.
 * @pw_element string $cExibirItemNF Exibir esta característica no item da NF-e emitida (S/N).
 * @pw_element string $cExibirItemPedido Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
 * @pw_complex prcAlterarCaractRequest
 */
class prcAlterarCaractRequest{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Conteúdo da característica.
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Exibir esta característica no item da NF-e emitida (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemNF;
	/**
	 * Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemPedido;
}

/**
 * Resposta da solicitação de alteração de uma característica para um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex prcAlterarCaractResponse
 */
class prcAlterarCaractResponse{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Exclui uma característica de um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex prcExcluirCaractRequest
 */
class prcExcluirCaractRequest{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
}

/**
 * Resposta da solicitação de exclusão da característica de um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex prcExcluirCaractResponse
 */
class prcExcluirCaractResponse{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Consulta uma característica de um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex prcConsultarCaractRequest
 */
class prcConsultarCaractRequest{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
}

/**
 * Resposta da solicitação de consulta da característica de um produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNomeCaract Nome da característica.
 * @pw_element string $cConteudo Conteúdo da característica.
 * @pw_element string $cExibirItemNF Exibir esta característica no item da NF-e emitida (S/N).
 * @pw_element string $cExibirItemPedido Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
 * @pw_element info $info Informações complemetares da característica.<BR>
 * @pw_complex prcConsultarCaractResponse
 */
class prcConsultarCaractResponse{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Nome da característica.
	 *
	 * @var string
	 */
	public $cNomeCaract;
	/**
	 * Conteúdo da característica.
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Exibir esta característica no item da NF-e emitida (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemNF;
	/**
	 * Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemPedido;
	/**
	 * Informações complemetares da característica.<BR>
	 *
	 * @var info
	 */
	public $info;
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