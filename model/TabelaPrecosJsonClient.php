<?php
/**
 * @service TabelaPrecosJsonClient
 * @author omie
 */
class TabelaPrecosJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/tabelaprecos/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/tabelaprecos/';

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
	 * Inclui uma tabela de preços.
	 *
	 * @param tprIncluirRequest $tprIncluirRequest Solicitação de Inclusão de uma Tabela de Preços.
	 * @return tprIncluirResponse Resposta da solicitação de Inclusão de uma Tabela de Preços.
	 */
	public function IncluirTabelaPreco($tprIncluirRequest){
		return self::_Call('IncluirTabelaPreco',Array(
			$tprIncluirRequest
		));
	}

	/**
	 * Altera uma tabela de preços.
	 *
	 * @param tprAlterarRequest $tprAlterarRequest Solicitação de Alteração de uma Tabela de Preços.
	 * @return tprAlterarResponse Resposta da solicitação de Alteração de uma Tabela de Preços.
	 */
	public function AlterarTabelaPreco($tprAlterarRequest){
		return self::_Call('AlterarTabelaPreco',Array(
			$tprAlterarRequest
		));
	}

	/**
	 * Exclui uma tabela de preços.
	 *
	 * @param tprExcluirRequest $tprExcluirRequest Solicitação de Exclusão de uma Tabela de Preços.
	 * @return tprExcluirResponse Resposta da solicitação de Exclusão de uma Tabela de Preços.
	 */
	public function ExcluirTabelaPreco($tprExcluirRequest){
		return self::_Call('ExcluirTabelaPreco',Array(
			$tprExcluirRequest
		));
	}

	/**
	 * Consulta uma tabela de preços.
	 *
	 * @param tprConsultarRequest $tprConsultarRequest Solicitação de Consulta de uma Tabela de Preços.
	 * @return tprConsultarResponse Resposta da Solicitação de Consulta de uma Tabela de Preços.
	 */
	public function ConsultarTabelaPreco($tprConsultarRequest){
		return self::_Call('ConsultarTabelaPreco',Array(
			$tprConsultarRequest
		));
	}

	/**
	 * Lista as tabelas de preço cadastradas.
	 *
	 * @param tprListarRequest $tprListarRequest Listagem de tabela de preços.
	 * @return tprListarResponse Resposta da solicitação de listagem de tabelas de preço.
	 */
	public function ListarTabelasPreco($tprListarRequest){
		return self::_Call('ListarTabelasPreco',Array(
			$tprListarRequest
		));
	}

	/**
	 * Lista os itens de uma tabela de preços.
	 *
	 * @param tprItensListarRequest $tprItensListarRequest Listagem de itens da tabela de preços.
	 * @return tprItensListarResponse Resposta da solicitação de listagem de itens da tabelas de preço.
	 */
	public function ListarTabelaItens($tprItensListarRequest){
		return self::_Call('ListarTabelaItens',Array(
			$tprItensListarRequest
		));
	}

	/**
	 * Ativa uma tabela de preços.
	 *
	 * @param tprAtivarRequest $tprAtivarRequest Solicitação de Ativação de uma Tabela de Preços.
	 * @return tprAtivarResponse Resposta da solicitação de Ativação de uma Tabela de Preços.
	 */
	public function AtivarTabelaPreco($tprAtivarRequest){
		return self::_Call('AtivarTabelaPreco',Array(
			$tprAtivarRequest
		));
	}

	/**
	 * Suspende uma tabela de preços.
	 *
	 * @param tprSuspenderRequest $tprSuspenderRequest Solicitação de Suspensão de uma Tabela de Preços.
	 * @return tprSuspenderResponse Resposta da solicitação de Suspensão de uma Tabela de Preços.
	 */
	public function SuspenderTabelaPreco($tprSuspenderRequest){
		return self::_Call('SuspenderTabelaPreco',Array(
			$tprSuspenderRequest
		));
	}

	/**
	 * Atualiza os produtos da tabela de preços.
	 *
	 * @param tprAtualizarRequest $tprAtualizarRequest Solicitação de Atualização dos produtos de uma Tabela de Preços.
	 * @return tprAtualizarResponse Resposta da solicitação de Atualização dos produtos de uma Tabela de Preços.
	 */
	public function AtualizarProdutos($tprAtualizarRequest){
		return self::_Call('AtualizarProdutos',Array(
			$tprAtualizarRequest
		));
	}
}

/**
 * Características da tabela de preço.
 *
 * @pw_element string $cTemValidade Indica se a Tabela de Preço possui Validade (S/N).
 * @pw_element string $dDtInicial Data Inicial da Validade da Tabela de Preço.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtFinal Data Final de Validade Tabela de Preço.<BR>No formato dd/mm/aaaa.
 * @pw_element string $cTemDesconto Indica se a Tabela de Preço possui Desconto Sugerido ou Máximo (S/N).
 * @pw_element decimal $nDescSugerido Percentual de Desconto Sugerido.
 * @pw_element decimal $nPercDescMax Percentual de Desconto Máximo Permitido.
 * @pw_element string $cArredPreco Indica se deve Arredondar o preço dos produtos (S/N).
 * @pw_complex caracteristicas
 */
class caracteristicas{
	/**
	 * Indica se a Tabela de Preço possui Validade (S/N).
	 *
	 * @var string
	 */
	public $cTemValidade;
	/**
	 * Data Inicial da Validade da Tabela de Preço.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtInicial;
	/**
	 * Data Final de Validade Tabela de Preço.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dDtFinal;
	/**
	 * Indica se a Tabela de Preço possui Desconto Sugerido ou Máximo (S/N).
	 *
	 * @var string
	 */
	public $cTemDesconto;
	/**
	 * Percentual de Desconto Sugerido.
	 *
	 * @var decimal
	 */
	public $nDescSugerido;
	/**
	 * Percentual de Desconto Máximo Permitido.
	 *
	 * @var decimal
	 */
	public $nPercDescMax;
	/**
	 * Indica se deve Arredondar o preço dos produtos (S/N).
	 *
	 * @var string
	 */
	public $cArredPreco;
}

/**
 * Dados dos filtros do cliente.
 *
 * @pw_element string $cTodosClientes Considerar todos os clientes nesta tabela de preços? (S/N)<BR>O padrão é "S".<BR>Quando informar "S", todos os demais campos deste grupo serão desconsiderados.<BR>Caso informe "N", pelo menos 1 dos campos deste grupo deverá ser informado.
 * @pw_element integer $nCodTag Considerar apenas os clientes de uma determinada Tag.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
 * @pw_element string $cTag Descrição da tag do cliente informada no campo nCodTag.<BR>O conteúdo deste campo é apenas informativo e não tem efeito na inclusão.<BR>Na inclusão utilize a tag "nCodTag".<BR>
 * @pw_element string $cUF Considerar apenas os clientes do Estado.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
 * @pw_complex clientes
 */
class clientes{
	/**
	 * Considerar todos os clientes nesta tabela de preços? (S/N)<BR>O padrão é "S".<BR>Quando informar "S", todos os demais campos deste grupo serão desconsiderados.<BR>Caso informe "N", pelo menos 1 dos campos deste grupo deverá ser informado.
	 *
	 * @var string
	 */
	public $cTodosClientes;
	/**
	 * Considerar apenas os clientes de uma determinada Tag.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
	 *
	 * @var integer
	 */
	public $nCodTag;
	/**
	 * Descrição da tag do cliente informada no campo nCodTag.<BR>O conteúdo deste campo é apenas informativo e não tem efeito na inclusão.<BR>Na inclusão utilize a tag "nCodTag".<BR>
	 *
	 * @var string
	 */
	public $cTag;
	/**
	 * Considerar apenas os clientes do Estado.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
	 *
	 * @var string
	 */
	public $cUF;
}

/**
 * Informações do cadastro da tabela de preços.
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
class info_preco{
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
 * Informações do cadastro do item.
 *
 * @pw_element string $dIncItem Data da Inclusão.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hIncItem Hora da Inclusão.<BR>No formato hh:mm:ss.
 * @pw_element string $uIncItem Usuário da Inclusão.
 * @pw_element string $dAltItem Data da Alteração.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hAltItem Hora da Alteração.<BR>No formato hh:mm:ss.
 * @pw_element string $uAltItem Usuário da Alteração.
 * @pw_element string $cImpAPIItem Importado pela API (S/N).
 * @pw_complex itemInfo
 */
class itemInfo{
	/**
	 * Data da Inclusão.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dIncItem;
	/**
	 * Hora da Inclusão.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hIncItem;
	/**
	 * Usuário da Inclusão.
	 *
	 * @var string
	 */
	public $uIncItem;
	/**
	 * Data da Alteração.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dAltItem;
	/**
	 * Hora da Alteração.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hAltItem;
	/**
	 * Usuário da Alteração.
	 *
	 * @var string
	 */
	public $uAltItem;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $cImpAPIItem;
}

/**
 * Itens da Tabela de Preços.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.<BR>
 * @pw_element string $cCodIntProd Código de integração do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código utilizado no seu aplicativo quando incluir um produto no Omie. <BR>Assim, poderá utilizá-lo para resgatar as informações do produto desejado.<BR>Caso informe esse campo, não informe a tag nCodProd. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.
 * @pw_element string $cCodigoProduto Código do produto.<BR>(Exibido na tela do aplicativo).
 * @pw_element string $cDescricaoProduto Descrição do produto.
 * @pw_element string $cNCM Código do NCM.<BR>No formato 9999.99.99
 * @pw_element string $cEAN EAN do produto.
 * @pw_element integer $nCodFamilia Código da Familia do Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da família gerado pelo Omie.<BR>
 * @pw_element string $cArredPreco Indica se deve Arredondar o preço dos produtos (S/N).
 * @pw_element string $cTemDesconto Indica se a Tabela de Preço possui Desconto Sugerido ou Máximo (S/N).
 * @pw_element decimal $nDescMaximo Percentual de Desconto Máximo Permitido.
 * @pw_element decimal $nDescSugerido Percentual de Desconto Sugerido.
 * @pw_element string $cManual Indica se o item foi modificado Manualmente (S/N).
 * @pw_element decimal $nPercDesconto Percentual de Desconto da tabela de preços.
 * @pw_element decimal $nPercAcrescimo Percentual de Acréscimo da tabela de preços.
 * @pw_element decimal $nValorCalculado Valor Calculado.
 * @pw_element decimal $nValorOriginal Valor Original.
 * @pw_element decimal $nValorTabela Valor da Tabela de Preços.
 * @pw_element itemInfo $itemInfo Informações do cadastro do item.
 * @pw_complex itensTabela
 */
class itensTabela{
	/**
	 * Código do produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do produto gerado pelo Omie.<BR>
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
	 * Código do produto.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigoProduto;
	/**
	 * Descrição do produto.
	 *
	 * @var string
	 */
	public $cDescricaoProduto;
	/**
	 * Código do NCM.<BR>No formato 9999.99.99
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * EAN do produto.
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Código da Familia do Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da família gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodFamilia;
	/**
	 * Indica se deve Arredondar o preço dos produtos (S/N).
	 *
	 * @var string
	 */
	public $cArredPreco;
	/**
	 * Indica se a Tabela de Preço possui Desconto Sugerido ou Máximo (S/N).
	 *
	 * @var string
	 */
	public $cTemDesconto;
	/**
	 * Percentual de Desconto Máximo Permitido.
	 *
	 * @var decimal
	 */
	public $nDescMaximo;
	/**
	 * Percentual de Desconto Sugerido.
	 *
	 * @var decimal
	 */
	public $nDescSugerido;
	/**
	 * Indica se o item foi modificado Manualmente (S/N).
	 *
	 * @var string
	 */
	public $cManual;
	/**
	 * Percentual de Desconto da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercDesconto;
	/**
	 * Percentual de Acréscimo da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercAcrescimo;
	/**
	 * Valor Calculado.
	 *
	 * @var decimal
	 */
	public $nValorCalculado;
	/**
	 * Valor Original.
	 *
	 * @var decimal
	 */
	public $nValorOriginal;
	/**
	 * Valor da Tabela de Preços.
	 *
	 * @var decimal
	 */
	public $nValorTabela;
	/**
	 * Informações do cadastro do item.
	 *
	 * @var itemInfo
	 */
	public $itemInfo;
}


/**
 * Tabela de preço com itens.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNome Nome da Tabela de Preço.
 * @pw_element string $cCodigo Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
 * @pw_element string $cAtiva Indica se a tabela de preços está ativa (S/N).<BR>
 * @pw_element string $cOrigem Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
 * @pw_element itensTabelaArray $itensTabela Itens da Tabela de Preços.
 * @pw_complex listaTabelaPreco
 */
class listaTabelaPreco{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Nome da Tabela de Preço.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Indica se a tabela de preços está ativa (S/N).<BR>
	 *
	 * @var string
	 */
	public $cAtiva;
	/**
	 * Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
	 *
	 * @var string
	 */
	public $cOrigem;
	/**
	 * Itens da Tabela de Preços.
	 *
	 * @var itensTabelaArray
	 */
	public $itensTabela;
}

/**
 * Lista das tabelas de preço.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNome Nome da Tabela de Preço.
 * @pw_element string $cCodigo Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
 * @pw_element string $cAtiva Indica se a tabela de preços está ativa (S/N).<BR>
 * @pw_element string $cOrigem Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
 * @pw_element produtos $produtos Dados dos filtros por produto.
 * @pw_element clientes $clientes Dados dos filtros do cliente.
 * @pw_element outrasInfo $outrasInfo Outros filtros da tabela de preços.
 * @pw_element caracteristicas $caracteristicas Características da tabela de preço.
 * @pw_element info $info Informações do cadastro da tabela de preços.
 * @pw_complex listaTabelasPreco
 */
class listaTabelasPreco{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Nome da Tabela de Preço.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Indica se a tabela de preços está ativa (S/N).<BR>
	 *
	 * @var string
	 */
	public $cAtiva;
	/**
	 * Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
	 *
	 * @var string
	 */
	public $cOrigem;
	/**
	 * Dados dos filtros por produto.
	 *
	 * @var produtos
	 */
	public $produtos;
	/**
	 * Dados dos filtros do cliente.
	 *
	 * @var clientes
	 */
	public $clientes;
	/**
	 * Outros filtros da tabela de preços.
	 *
	 * @var outrasInfo
	 */
	public $outrasInfo;
	/**
	 * Características da tabela de preço.
	 *
	 * @var caracteristicas
	 */
	public $caracteristicas;
	/**
	 * Informações do cadastro da tabela de preços.
	 *
	 * @var info
	 */
	public $info;
}


/**
 * Dados dos filtros por produto.
 *
 * @pw_element string $cTodosProdutos Considerar todos os produtos nesta tabela de preços? (S/N)<BR>O padrão é "S".<BR>Quando informar "S", todos os demais campos deste grupo serão desconsiderados.<BR>Caso informe "N", pelo menos 1 dos campos deste grupo deverá ser informado.
 * @pw_element integer $nCodFamilia Código da Familia do Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da família gerado pelo Omie.<BR>
 * @pw_element string $cNCM Código do NCM.<BR>No formato 9999.99.99
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
 * @pw_element string $cConteudo Conteúdo da característica.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
 * @pw_element integer $nCodFornec Código do fornecedor.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do fornecedor gerado pelo Omie.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
 * @pw_complex produtos
 */
class produtos{
	/**
	 * Considerar todos os produtos nesta tabela de preços? (S/N)<BR>O padrão é "S".<BR>Quando informar "S", todos os demais campos deste grupo serão desconsiderados.<BR>Caso informe "N", pelo menos 1 dos campos deste grupo deverá ser informado.
	 *
	 * @var string
	 */
	public $cTodosProdutos;
	/**
	 * Código da Familia do Produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da família gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodFamilia;
	/**
	 * Código do NCM.<BR>No formato 9999.99.99
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Conteúdo da característica.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Código do fornecedor.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno do fornecedor gerado pelo Omie.<BR>Será ignorado caso o campo "cTodosProdutos" estiver preenhido com "S".
	 *
	 * @var integer
	 */
	public $nCodFornec;
}

/**
 * Outros filtros da tabela de preços.
 *
 * @pw_element integer $nCodOrigTab Código da Tabela de Preço Original.
 * @pw_element decimal $nPercAcrescimo Percentual de Acréscimo da tabela de preços.
 * @pw_element decimal $nPercDesconto Percentual de Desconto da tabela de preços.
 * @pw_complex outrasInfo
 */
class outrasInfo{
	/**
	 * Código da Tabela de Preço Original.
	 *
	 * @var integer
	 */
	public $nCodOrigTab;
	/**
	 * Percentual de Acréscimo da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercAcrescimo;
	/**
	 * Percentual de Desconto da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercDesconto;
}

/**
 * Solicitação de Alteração de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNome Nome da Tabela de Preço.
 * @pw_element string $cCodigo Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
 * @pw_element produtos $produtos Dados dos filtros por produto.
 * @pw_element clientes $clientes Dados dos filtros do cliente.
 * @pw_element outrasInfo $outrasInfo Outros filtros da tabela de preços.
 * @pw_element caracteristicas $caracteristicas Características da tabela de preço.
 * @pw_element string $cOrigem Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
 * @pw_complex tprAlterarRequest
 */
class tprAlterarRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Nome da Tabela de Preço.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Dados dos filtros por produto.
	 *
	 * @var produtos
	 */
	public $produtos;
	/**
	 * Dados dos filtros do cliente.
	 *
	 * @var clientes
	 */
	public $clientes;
	/**
	 * Outros filtros da tabela de preços.
	 *
	 * @var outrasInfo
	 */
	public $outrasInfo;
	/**
	 * Características da tabela de preço.
	 *
	 * @var caracteristicas
	 */
	public $caracteristicas;
	/**
	 * Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
	 *
	 * @var string
	 */
	public $cOrigem;
}

/**
 * Resposta da solicitação de Alteração de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprAlterarResponse
 */
class tprAlterarResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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
 * Solicitação de Ativação de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex tprAtivarRequest
 */
class tprAtivarRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
}

/**
 * Resposta da solicitação de Ativação de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprAtivarResponse
 */
class tprAtivarResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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
 * Solicitação de Atualização dos produtos de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element decimal $nPercAcrescimo Percentual de Acréscimo da tabela de preços.
 * @pw_element decimal $nPercDesconto Percentual de Desconto da tabela de preços.
 * @pw_element string $cArredPreco Indica se deve Arredondar o preço dos produtos (S/N).
 * @pw_complex tprAtualizarRequest
 */
class tprAtualizarRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Percentual de Acréscimo da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercAcrescimo;
	/**
	 * Percentual de Desconto da tabela de preços.
	 *
	 * @var decimal
	 */
	public $nPercDesconto;
	/**
	 * Indica se deve Arredondar o preço dos produtos (S/N).
	 *
	 * @var string
	 */
	public $cArredPreco;
}

/**
 * Resposta da solicitação de Atualização dos produtos de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprAtualizarResponse
 */
class tprAtualizarResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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
 * Solicitação de Consulta de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex tprConsultarRequest
 */
class tprConsultarRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
}

/**
 * Resposta da Solicitação de Consulta de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNome Nome da Tabela de Preço.
 * @pw_element string $cCodigo Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
 * @pw_element string $cAtiva Indica se a tabela de preços está ativa (S/N).<BR>
 * @pw_element string $cOrigem Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
 * @pw_element produtos $produtos Dados dos filtros por produto.
 * @pw_element clientes $clientes Dados dos filtros do cliente.
 * @pw_element outrasInfo $outrasInfo Outros filtros da tabela de preços.
 * @pw_element caracteristicas $caracteristicas Características da tabela de preço.
 * @pw_element info $info Informações do cadastro da tabela de preços.
 * @pw_complex tprConsultarResponse
 */
class tprConsultarResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Nome da Tabela de Preço.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Indica se a tabela de preços está ativa (S/N).<BR>
	 *
	 * @var string
	 */
	public $cAtiva;
	/**
	 * Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
	 *
	 * @var string
	 */
	public $cOrigem;
	/**
	 * Dados dos filtros por produto.
	 *
	 * @var produtos
	 */
	public $produtos;
	/**
	 * Dados dos filtros do cliente.
	 *
	 * @var clientes
	 */
	public $clientes;
	/**
	 * Outros filtros da tabela de preços.
	 *
	 * @var outrasInfo
	 */
	public $outrasInfo;
	/**
	 * Características da tabela de preço.
	 *
	 * @var caracteristicas
	 */
	public $caracteristicas;
	/**
	 * Informações do cadastro da tabela de preços.
	 *
	 * @var info
	 */
	public $info;
}

/**
 * Solicitação de Exclusão de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex tprExcluirRequest
 */
class tprExcluirRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
}

/**
 * Resposta da solicitação de Exclusão de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprExcluirResponse
 */
class tprExcluirResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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
 * Solicitação de Inclusão de uma Tabela de Preços.
 *
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNome Nome da Tabela de Preço.
 * @pw_element string $cCodigo Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
 * @pw_element produtos $produtos Dados dos filtros por produto.
 * @pw_element clientes $clientes Dados dos filtros do cliente.
 * @pw_element outrasInfo $outrasInfo Outros filtros da tabela de preços.
 * @pw_element caracteristicas $caracteristicas Características da tabela de preço.
 * @pw_element string $cOrigem Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
 * @pw_complex tprIncluirRequest
 */
class tprIncluirRequest{
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
	/**
	 * Nome da Tabela de Preço.
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Código da Tabela de Preço.<BR>(Exibido na tela do aplicativo).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Dados dos filtros por produto.
	 *
	 * @var produtos
	 */
	public $produtos;
	/**
	 * Dados dos filtros do cliente.
	 *
	 * @var clientes
	 */
	public $clientes;
	/**
	 * Outros filtros da tabela de preços.
	 *
	 * @var outrasInfo
	 */
	public $outrasInfo;
	/**
	 * Características da tabela de preço.
	 *
	 * @var caracteristicas
	 */
	public $caracteristicas;
	/**
	 * Origem da Tabela de Preços.<BR>Pode ser:<BR>PRD - Lê o preço do cadastro de produtos.<BR>CMC - Lê o preço do CMC do produto.<BR>TBL - Lê o preço de uma tabela específica informada na tag 'nCodOrigTab'.<BR>
	 *
	 * @var string
	 */
	public $cOrigem;
}

/**
 * Resposta da solicitação de Inclusão de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprIncluirResponse
 */
class tprIncluirResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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
 * Listagem de itens da tabela de preços.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $cOrdenarPor Ordem os resultados da página por:<BR>CODIGO - Código da Tabela de Preço.<BR>CODINT - Código de Integração da Tabela de Preço.<BR>NOME - Nome da Tabela de Preço.
 * @pw_element string $cOrdemDecrescente Indica se a ordem de exibição é Decrescente caso seja informado "S".
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex tprItensListarRequest
 */
class tprItensListarRequest{
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
	 * Ordem os resultados da página por:<BR>CODIGO - Código da Tabela de Preço.<BR>CODINT - Código de Integração da Tabela de Preço.<BR>NOME - Nome da Tabela de Preço.
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
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
}

/**
 * Resposta da solicitação de listagem de itens da tabelas de preço.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nTotPaginas Número total de páginas encontradas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros Número total de registros encontrados.
 * @pw_element listaTabelaPreco $listaTabelaPreco Tabela de preço com itens.
 * @pw_complex tprItensListarResponse
 */
class tprItensListarResponse{
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
	 * Tabela de preço com itens.
	 *
	 * @var listaTabelaPreco
	 */
	public $listaTabelaPreco;
}

/**
 * Listagem de tabela de preços.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $cOrdenarPor Ordem os resultados da página por:<BR>CODIGO - Código da Tabela de Preço.<BR>CODINT - Código de Integração da Tabela de Preço.<BR>NOME - Nome da Tabela de Preço.
 * @pw_element string $cOrdemDecrescente Indica se a ordem de exibição é Decrescente caso seja informado "S".
 * @pw_element string $dDtIncDe Data de inclusão inicial.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtIncAte Data de inclusão final.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtAltDe Data de alteração inicial.<BR>No formato dd/mm/aaaa.
 * @pw_element string $dDtAltAte Data de alteração final.<BR>No formato dd/mm/aaaa.
 * @pw_element integer $nCodTag Considerar apenas os clientes de uma determinada Tag.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
 * @pw_complex tprListarRequest
 */
class tprListarRequest{
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
	 * Ordem os resultados da página por:<BR>CODIGO - Código da Tabela de Preço.<BR>CODINT - Código de Integração da Tabela de Preço.<BR>NOME - Nome da Tabela de Preço.
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
	 * Considerar apenas os clientes de uma determinada Tag.<BR>Será ignorado caso o campo "cTodosClientes" estiver preenhido com "S".
	 *
	 * @var integer
	 */
	public $nCodTag;
}

/**
 * Resposta da solicitação de listagem de tabelas de preço.
 *
 * @pw_element integer $nPagina Número da página resgatada.
 * @pw_element integer $nTotPaginas Número total de páginas encontradas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros Número total de registros encontrados.
 * @pw_element listaTabelasPrecoArray $listaTabelasPreco Lista das tabelas de preço.
 * @pw_complex tprListarResponse
 */
class tprListarResponse{
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
	 * Lista das tabelas de preço.
	 *
	 * @var listaTabelasPrecoArray
	 */
	public $listaTabelasPreco;
}

/**
 * Solicitação de Suspensão de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_complex tprSuspenderRequest
 */
class tprSuspenderRequest{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
}

/**
 * Resposta da solicitação de Suspensão de uma Tabela de Preços.
 *
 * @pw_element integer $nCodTabPreco Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
 * @pw_element string $cCodIntTabPreco Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cCodStatus Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro duranteo o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $cDesStatus Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex tprSuspenderResponse
 */
class tprSuspenderResponse{
	/**
	 * Código da Tabela de Preços.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da Tabela de Preços gerado pelo Omie.<BR>
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Código de integração da Tabela de Preços.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da Tabela de Preços utilizado no seu aplicativo quando incluir uma Tabela de Preços no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da Tabela de Preços desejada.<BR>Caso informe esse campo, não informe a tag nCodTabPreco. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntTabPreco;
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