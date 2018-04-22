<?php
/**
 * @service ConsultaEstoqueJsonClient
 * @author omie
 */
class ConsultaEstoqueJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/estoque/consulta/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/estoque/consulta/';

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
	 * Obtém a Posição de Estoque de um determinado produto para a data
	 *
	 * @param estoque_mov_consulta_cadastro $estoque_mov_consulta_cadastro Registro de Consulta de Estoque
	 * @return estoque_mov_consulta_cadastro_resposta Status de Resposta da Consulta de Estoque
	 */
	public function PosicaoEstoque($estoque_mov_consulta_cadastro){
		return self::_Call('PosicaoEstoque',Array(
			$estoque_mov_consulta_cadastro
		));
	}

	/**
	 * Consulta do Movimento de Estoque
	 *
	 * @param estoqueMovimentoRequest $estoqueMovimentoRequest Consulta Movimento de Estoque de um Produto
	 * @return estoqueMovimentoResponse Resposta do consulta de movimentação do Estoque
	 */
	public function MovimentoEstoque($estoqueMovimentoRequest){
		return self::_Call('MovimentoEstoque',Array(
			$estoqueMovimentoRequest
		));
	}

	/**
	 * Lista as posições de estoque de um dia.
	 *
	 * @param ListarEstPosRequest $ListarEstPosRequest Solicitação da listagem da posição do estoque.
	 * @return ListarEstPosResponse Resposta da solicitação da listagem de posição de estoque.
	 */
	public function ListarPosEstoque($ListarEstPosRequest){
		return self::_Call('ListarPosEstoque',Array(
			$ListarEstPosRequest
		));
	}
}

/**
 * Registro de Consulta de Estoque
 *
 * @pw_element integer $id_prod ID do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $data Data da Consulta de Estoque
 * @pw_complex estoque_mov_consulta_cadastro
 */
class estoque_mov_consulta_cadastro{
	/**
	 * ID do Produto
	 *
	 * @var integer
	 */
	public $id_prod;
	/**
	 * Código de Integração do Produto
	 *
	 * @var string
	 */
	public $cod_int;
	/**
	 * Data da Consulta de Estoque
	 *
	 * @var string
	 */
	public $data;
}

/**
 * Status de Resposta da Consulta de Estoque
 *
 * @pw_element string $codigo_status Código de Resposta do Status da Consulta de Estoque
 * @pw_element string $descricao_status Descrição de Resposta do Status da Consulta de Estoque
 * @pw_element decimal $saldo Saldo de Estoque da Consulta
 * @pw_element decimal $cmc Valor do CMC da Consulta de Estoque
 * @pw_complex estoque_mov_consulta_cadastro_resposta
 */
class estoque_mov_consulta_cadastro_resposta{
	/**
	 * Código de Resposta do Status da Consulta de Estoque
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição de Resposta do Status da Consulta de Estoque
	 *
	 * @var string
	 */
	public $descricao_status;
	/**
	 * Saldo de Estoque da Consulta
	 *
	 * @var decimal
	 */
	public $saldo;
	/**
	 * Valor do CMC da Consulta de Estoque
	 *
	 * @var decimal
	 */
	public $cmc;
}

/**
 * Consulta Movimento de Estoque de um Produto
 *
 * @pw_element integer $id_prod Código do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $dataInicial Data Inicial de Consulta de Estoque
 * @pw_element string $dataFinal Data Final da Consulta de Estoque
 * @pw_complex estoqueMovimentoRequest
 */
class estoqueMovimentoRequest{
	/**
	 * Código do Produto
	 *
	 * @var integer
	 */
	public $id_prod;
	/**
	 * Código de Integração do Produto
	 *
	 * @var string
	 */
	public $cod_int;
	/**
	 * Data Inicial de Consulta de Estoque
	 *
	 * @var string
	 */
	public $dataInicial;
	/**
	 * Data Final da Consulta de Estoque
	 *
	 * @var string
	 */
	public $dataFinal;
}

/**
 * Resposta do consulta de movimentação do Estoque
 *
 * @pw_element integer $id_prod Código do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $descricao Descrição do produto.
 * @pw_element movProdutoArray $movProduto Movimentação do produto
 * @pw_complex estoqueMovimentoResponse
 */
class estoqueMovimentoResponse{
	/**
	 * Código do Produto
	 *
	 * @var integer
	 */
	public $id_prod;
	/**
	 * Código de Integração do Produto
	 *
	 * @var string
	 */
	public $cod_int;
	/**
	 * Descrição do produto.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Movimentação do produto
	 *
	 * @var movProdutoArray
	 */
	public $movProduto;
}

/**
 * Movimentação do produto
 *
 * @pw_element string $dtMov Data do movimento
 * @pw_element integer $idMov Identificação do Movimento.
 * @pw_element string $codOrigem Código da Origem
 * @pw_element string $desOrigem Descrição da Origem
 * @pw_element string $numDoc Número do Documento (Nota Fiscal)
 * @pw_element movPeriodoArray $movPeriodo Movimentação no período.
 * @pw_complex movProduto
 */
class movProduto{
	/**
	 * Data do movimento
	 *
	 * @var string
	 */
	public $dtMov;
	/**
	 * Identificação do Movimento.
	 *
	 * @var integer
	 */
	public $idMov;
	/**
	 * Código da Origem
	 *
	 * @var string
	 */
	public $codOrigem;
	/**
	 * Descrição da Origem
	 *
	 * @var string
	 */
	public $desOrigem;
	/**
	 * Número do Documento (Nota Fiscal)
	 *
	 * @var string
	 */
	public $numDoc;
	/**
	 * Movimentação no período.
	 *
	 * @var movPeriodoArray
	 */
	public $movPeriodo;
}


/**
 * Movimentação no período.
 *
 * @pw_element string $tipo tipo do lançamento (Anterior,Entrada,Saída,Atual)
 * @pw_element decimal $qtde Quantidade
 * @pw_element decimal $cmcUnitario Custo Médio Contábil.
 * @pw_element decimal $cmcTotal CMC Total
 * @pw_complex movPeriodo
 */
class movPeriodo{
	/**
	 * tipo do lançamento (Anterior,Entrada,Saída,Atual)
	 *
	 * @var string
	 */
	public $tipo;
	/**
	 * Quantidade
	 *
	 * @var decimal
	 */
	public $qtde;
	/**
	 * Custo Médio Contábil.
	 *
	 * @var decimal
	 */
	public $cmcUnitario;
	/**
	 * CMC Total
	 *
	 * @var decimal
	 */
	public $cmcTotal;
}


/**
 * Lista a posição do estoque dos produtos encontrados.
 *
 * @pw_element integer $nCodProd Código do Produto.<BR>(Código interno para integração)
 * @pw_element string $cCodigo Código do produto.<BR>(Visualizado na tela).
 * @pw_element string $cDescricao Descrição do produto.
 * @pw_element decimal $nSaldo Saldo do produto.
 * @pw_element decimal $nCMC Custo Médio Contábil.
 * @pw_complex produtos
 */
class produtos{
	/**
	 * Código do Produto.<BR>(Código interno para integração)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do produto.<BR>(Visualizado na tela).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Descrição do produto.
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Saldo do produto.
	 *
	 * @var decimal
	 */
	public $nSaldo;
	/**
	 * Custo Médio Contábil.
	 *
	 * @var decimal
	 */
	public $nCMC;
}


/**
 * Resposta da solicitação da listagem de posição de estoque.
 *
 * @pw_element integer $nPagina Número da página retornada.
 * @pw_element integer $nTotPaginas Número total de páginas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros total de registros encontrados.
 * @pw_element string $dDataPosicao Data da posição do estoque.
 * @pw_element produtosArray $produtos Lista a posição do estoque dos produtos encontrados.
 * @pw_complex ListarEstPosResponse
 */
class ListarEstPosResponse{
	/**
	 * Número da página retornada.
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Número total de páginas.
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
	 * total de registros encontrados.
	 *
	 * @var integer
	 */
	public $nTotRegistros;
	/**
	 * Data da posição do estoque.
	 *
	 * @var string
	 */
	public $dDataPosicao;
	/**
	 * Lista a posição do estoque dos produtos encontrados.
	 *
	 * @var produtosArray
	 */
	public $produtos;
}

/**
 * Solicitação da listagem da posição do estoque.
 *
 * @pw_element integer $nPagina Número da página retornada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $dDataPosicao Data da posição do estoque.
 * @pw_element string $cExibeTodos Exibir todos os produtos mesmo que não haja movimento.<BR>Padrão: "N"
 * @pw_complex ListarEstPosRequest
 */
class ListarEstPosRequest{
	/**
	 * Número da página retornada.
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
	 * Data da posição do estoque.
	 *
	 * @var string
	 */
	public $dDataPosicao;
	/**
	 * Exibir todos os produtos mesmo que não haja movimento.<BR>Padrão: "N"
	 *
	 * @var string
	 */
	public $cExibeTodos;
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