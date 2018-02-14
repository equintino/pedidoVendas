<?php
namespace etapas;
/**
 * @service PedidoVendaEtapaJsonClient
 * @author omie
 */
class PedidoVendaEtapaJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/pedidoetapas/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/pedidoetapas/';

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
	 * Lista as etapas do Pedido de Venda de Produtos.
	 *
	 * @param pEtapaListarRequest $pEtapaListarRequest Solicitação de listagem de mudanças de etapa do pedido de vendas.
	 * @return pEtapaListarResponse Resposta da listagem de Status do Pedido de Vendas.
	 */
	public function ListarEtapasPedido($pEtapaListarRequest){
		return self::_Call('ListarEtapasPedido',Array(
			$pEtapaListarRequest
		));
	}
}

/**
 * Solicitação de listagem de mudanças de etapa do pedido de vendas.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $cOrdenarPor Ordem os resultados da página por:<BR>CODIGO - Código do Pedido de Venda.<BR>DATAHORA - Data + Hora da mudança da etapa do pedido.<BR>
 * @pw_element string $cOrdemDecrescente Indica se a ordem de exibição é Decrescente caso seja informado "S".
 * @pw_element string $dDtInicial Data inicial.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtFinal Data final.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cHrInicial Hora inicial.<BR>No formato hh:mm:ss
 * @pw_element string $cHrFinal Hora final.<BR>No Formato hh:mm:ss.
 * @pw_element integer $nCodPed Código do Pedido de Venda de Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do Pedido de Venda gerado pelo Omie.
 * @pw_element string $cCodIntPed Código de Integração do Pedido de Venda de Produto.
 * @pw_element string $cEtapa Etapa do Pedido de Venda.
 * @pw_complex pEtapaListarRequest
 */
class pEtapaListarRequest{
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
	 * Ordem os resultados da página por:<BR>CODIGO - Código do Pedido de Venda.<BR>DATAHORA - Data + Hora da mudança da etapa do pedido.<BR>
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
	 * Data inicial.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtInicial;
	/**
	 * Data final.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtFinal;
	/**
	 * Hora inicial.<BR>No formato hh:mm:ss
	 *
	 * @var string
	 */
	public $cHrInicial;
	/**
	 * Hora final.<BR>No Formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $cHrFinal;
	/**
	 * Código do Pedido de Venda de Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do Pedido de Venda gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de Integração do Pedido de Venda de Produto.
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Etapa do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cEtapa;
}

/**
 * Outras informações do pedido
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
class info{
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
 * Dados da Devolução.
 *
 * @pw_element string $cDevolvido Pedido de Vendas foi devolvido (S/N)?
 * @pw_element string $dDtDev Data da Devolução do Pedido.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cHrDev Hora da Devolução do Pedido.<BR>No formato hh:mm:ss.
 * @pw_element string $cUsDev Usuário que realizou a devolução do pedido.
 * @pw_complex devolucao
 */
class devolucao{
	/**
	 * Pedido de Vendas foi devolvido (S/N)?
	 *
	 * @var string
	 */
	public $cDevolvido;
	/**
	 * Data da Devolução do Pedido.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtDev;
	/**
	 * Hora da Devolução do Pedido.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $cHrDev;
	/**
	 * Usuário que realizou a devolução do pedido.
	 *
	 * @var string
	 */
	public $cUsDev;
}

/**
 * Dados do Cancelamento.
 *
 * @pw_element string $cCancelado Pedido de Vendas foi cancelado (S/N)?
 * @pw_element string $dDtCanc Data do Cancelamento do Pedido.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cHrCanc Hora do Cancelamento do Pedido.<BR>No formato hh:mm:ss.
 * @pw_element string $cUsCanc Usuário que realizou o Cancelamento do pedido.
 * @pw_complex cancelamento
 */
class cancelamento{
	/**
	 * Pedido de Vendas foi cancelado (S/N)?
	 *
	 * @var string
	 */
	public $cCancelado;
	/**
	 * Data do Cancelamento do Pedido.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtCanc;
	/**
	 * Hora do Cancelamento do Pedido.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $cHrCanc;
	/**
	 * Usuário que realizou o Cancelamento do pedido.
	 *
	 * @var string
	 */
	public $cUsCanc;
}

/**
 * Dados do faturamento
 *
 * @pw_element string $cFaturado Pedido de Vendas foi faturado (S/N)?
 * @pw_element string $dDtFat Data de Faturamento do Pedido.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cHrFat Hora do Faturamento do Pedido.<BR>No formato hh:mm:ss.
 * @pw_element string $cUsDev Usuário que realizou o faturamento do pedido.
 * @pw_element string $cAutorizado NFE foi autorizada (S/N)?
 * @pw_element string $cDenegado NFE foi denegada (S/N)?
 * @pw_element string $cDANFE DANFE foi gerado (S/N)?
 * @pw_element string $cAmbiente Ambiente em que a NF-e foi gerada.<BR>Pode ser:<BR>H - Homologação.<BR>P - Produção.
 * @pw_element string $cChaveNFE Chave da NF-e gerada.
 * @pw_element string $cNumNFE Número da NF-e Gerada.
 * @pw_element string $cSerieNFE Série da NF-e gerada.&nbsp;
 * @pw_element string $dDtSainda Data de Saída da NF-e.
 * @pw_element string $cHrSaida Hora de Saída da NF-e&nbsp;
 * @pw_complex faturamento
 */
class faturamento{
	/**
	 * Pedido de Vendas foi faturado (S/N)?
	 *
	 * @var string
	 */
	public $cFaturado;
	/**
	 * Data de Faturamento do Pedido.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtFat;
	/**
	 * Hora do Faturamento do Pedido.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $cHrFat;
	/**
	 * Usuário que realizou o faturamento do pedido.
	 *
	 * @var string
	 */
	public $cUsDev;
	/**
	 * NFE foi autorizada (S/N)?
	 *
	 * @var string
	 */
	public $cAutorizado;
	/**
	 * NFE foi denegada (S/N)?
	 *
	 * @var string
	 */
	public $cDenegado;
	/**
	 * DANFE foi gerado (S/N)?
	 *
	 * @var string
	 */
	public $cDANFE;
	/**
	 * Ambiente em que a NF-e foi gerada.<BR>Pode ser:<BR>H - Homologação.<BR>P - Produção.
	 *
	 * @var string
	 */
	public $cAmbiente;
	/**
	 * Chave da NF-e gerada.
	 *
	 * @var string
	 */
	public $cChaveNFE;
	/**
	 * Número da NF-e Gerada.
	 *
	 * @var string
	 */
	public $cNumNFE;
	/**
	 * Série da NF-e gerada.&nbsp;
	 *
	 * @var string
	 */
	public $cSerieNFE;
	/**
	 * Data de Saída da NF-e.
	 *
	 * @var string
	 */
	public $dDtSainda;
	/**
	 * Hora de Saída da NF-e&nbsp;
	 *
	 * @var string
	 */
	public $cHrSaida;
}

/**
 * Lista de status do pedido encontrados.
 *
 * @pw_element integer $nCodPed Código do Pedido de Venda de Produto.
 * @pw_element string $cCodIntPed Código de Integração do Pedido de Venda de Produto.
 * @pw_element string $cNumero Número do Pedido de Venda.<BR>(Visualizado na tela do Omie.)
 * @pw_element string $cEtapa Etapa do Pedido de Venda.
 * @pw_element string $dDtEtapa Data da Etapa do Pedido de Venda.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cHrEtapa Hora da Etapa do Pedido de Venda.<BR>No formato hh:mm:ss.
 * @pw_element string $cUsEtapa Usuário que mudou a Etapa do Pedido de Venda.
 * @pw_element faturamento $faturamento Dados do faturamento
 * @pw_element cancelamento $cancelamento Dados do Cancelamento.
 * @pw_element devolucao $devolucao Dados da Devolução.
 * @pw_element info $info Outras informações do pedido
 * @pw_complex etapasPedido
 */
class etapasPedido{
	/**
	 * Código do Pedido de Venda de Produto.
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de Integração do Pedido de Venda de Produto.
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Número do Pedido de Venda.<BR>(Visualizado na tela do Omie.)
	 *
	 * @var string
	 */
	public $cNumero;
	/**
	 * Etapa do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cEtapa;
	/**
	 * Data da Etapa do Pedido de Venda.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtEtapa;
	/**
	 * Hora da Etapa do Pedido de Venda.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $cHrEtapa;
	/**
	 * Usuário que mudou a Etapa do Pedido de Venda.
	 *
	 * @var string
	 */
	public $cUsEtapa;
	/**
	 * Dados do faturamento
	 *
	 * @var faturamento
	 */
	public $faturamento;
	/**
	 * Dados do Cancelamento.
	 *
	 * @var cancelamento
	 */
	public $cancelamento;
	/**
	 * Dados da Devolução.
	 *
	 * @var devolucao
	 */
	public $devolucao;
	/**
	 * Outras informações do pedido
	 *
	 * @var info
	 */
	public $info;
}


/**
 * Resposta da listagem de Status do Pedido de Vendas.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nTotPaginas Número total de páginas encontradas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros Número total de registros encontrados.
 * @pw_element etapasPedidoArray $etapasPedido Lista de status do pedido encontrados.
 * @pw_complex pEtapaListarResponse
 */
class pEtapaListarResponse{
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
	 * Lista de status do pedido encontrados.
	 *
	 * @var etapasPedidoArray
	 */
	public $etapasPedido;
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