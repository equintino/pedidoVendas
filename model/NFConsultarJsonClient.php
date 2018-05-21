<?php
/**
 * @service NFConsultarJsonClient
 * @author omie
 */
class NFConsultarJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/produtos/nfconsultar/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/produtos/nfconsultar/';

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
	 * Consulta um Nota Fiscal
	 *
	 * @param nfChave $nfChave Chave de pesquisa da Nota Fiscal&nbsp;
	 * @return nfCadastro Dados da Nota Fiscal&nbsp;
	 */
	public function ConsultarNF($nfChave){
		return self::_Call('ConsultarNF',Array(
			$nfChave
		));
	}

	/**
	 * Listar as Notas Fiscais cadastradas.
	 *
	 * @param nfListarRequest $nfListarRequest Solicitação de Listagem de Notas Fiscais
	 * @return nfListarResponse Resposta da listagem de Notas Fiscais
	 */
	public function ListarNF($nfListarRequest){
		return self::_Call('ListarNF',Array(
			$nfListarRequest
		));
	}
}

/**
 * Dados complementares da NF
 *
 * @pw_element integer $nIdNF Código da Nota Fiscal.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element integer $nIdPedido Código de identificação do pedido.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element string $cCodCateg Código da categoria.
 * @pw_element string $cChaveNFe Chave da NF-e
 * @pw_element integer $nIdReceb Identificação do Recebimento.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element integer $nIdTransp Identificação da Transportadora.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element string $cModFrete Código da modalidade do frete.
 * @pw_complex compl
 */
class compl{
	/**
	 * Código da Nota Fiscal.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nIdNF;
	/**
	 * Código de identificação do pedido.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nIdPedido;
	/**
	 * Código da categoria.
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Chave da NF-e
	 *
	 * @var string
	 */
	public $cChaveNFe;
	/**
	 * Identificação do Recebimento.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nIdReceb;
	/**
	 * Identificação da Transportadora.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nIdTransp;
	/**
	 * Código da modalidade do frete.
	 *
	 * @var string
	 */
	public $cModFrete;
}

/**
 * Detalhes dos itens da Nota Fiscal.
 *
 * @pw_element prod $prod TAG de grupo do detalhamento de Produtos e Serviços da NF-e
 * @pw_element nfProdInt $nfProdInt Informações de Integração dos itens da NF
 * @pw_complex det
 */
class det{
	/**
	 * TAG de grupo do detalhamento de Produtos e Serviços da NF-e
	 *
	 * @var prod
	 */
	public $prod;
	/**
	 * Informações de Integração dos itens da NF
	 *
	 * @var nfProdInt
	 */
	public $nfProdInt;
}


/**
 * TAG de grupo do detalhamento de Produtos e Serviços da NF-e
 *
 * @pw_element string $cProd Código do produto ou serviço
 * @pw_element string $cEAN GTIN (Global Trade Item Number) da unidade tributável, antigo código EAN ou código de barras
 * @pw_element string $xProd Descrição do produto ou serviço
 * @pw_element string $NCM Código do NCM
 * @pw_element string $EXTIPI Código da situação tributária ICMS
 * @pw_element string $CFOP Código Fiscal de Operações e Prestações
 * @pw_element string $uCom Unidade Tributável
 * @pw_element decimal $qCom Quantidade Comercial
 * @pw_element decimal $vUnCom Valor Unitário de tributação
 * @pw_element decimal $vProd Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)
 * @pw_element string $cEANTrib GTIN (Global Trade Item Number) da unidade tributável, antigo código EAN ou código de barras
 * @pw_element string $uTrib Unidade Tributável
 * @pw_element decimal $qTrib Quantidade Tributável
 * @pw_element decimal $vUnTrib Valor Unitário de tributação
 * @pw_element decimal $vFrete Valor Total do Frete
 * @pw_element decimal $vSeg Valor Total do Seguro
 * @pw_element decimal $vDesc Valor do Desconto
 * @pw_element decimal $vOutro Valor da Retenção da Previdência Social
 * @pw_element decimal $indTot Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)
 * @pw_element string $cProdOrig Código do produto conforme informado na Nota Fiscal.
 * @pw_element string $xProdOrig Descrição original do produto conforme informado na Nota Fiscal.
 * @pw_element decimal $nCMCUnitario CMC Unitário
 * @pw_element decimal $nCMCTotal CMC Total.
 * @pw_complex prod
 */
class prod{
	/**
	 * Código do produto ou serviço
	 *
	 * @var string
	 */
	public $cProd;
	/**
	 * GTIN (Global Trade Item Number) da unidade tributável, antigo código EAN ou código de barras
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Descrição do produto ou serviço
	 *
	 * @var string
	 */
	public $xProd;
	/**
	 * Código do NCM
	 *
	 * @var string
	 */
	public $NCM;
	/**
	 * Código da situação tributária ICMS
	 *
	 * @var string
	 */
	public $EXTIPI;
	/**
	 * Código Fiscal de Operações e Prestações
	 *
	 * @var string
	 */
	public $CFOP;
	/**
	 * Unidade Tributável
	 *
	 * @var string
	 */
	public $uCom;
	/**
	 * Quantidade Comercial
	 *
	 * @var decimal
	 */
	public $qCom;
	/**
	 * Valor Unitário de tributação
	 *
	 * @var decimal
	 */
	public $vUnCom;
	/**
	 * Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)
	 *
	 * @var decimal
	 */
	public $vProd;
	/**
	 * GTIN (Global Trade Item Number) da unidade tributável, antigo código EAN ou código de barras
	 *
	 * @var string
	 */
	public $cEANTrib;
	/**
	 * Unidade Tributável
	 *
	 * @var string
	 */
	public $uTrib;
	/**
	 * Quantidade Tributável
	 *
	 * @var decimal
	 */
	public $qTrib;
	/**
	 * Valor Unitário de tributação
	 *
	 * @var decimal
	 */
	public $vUnTrib;
	/**
	 * Valor Total do Frete
	 *
	 * @var decimal
	 */
	public $vFrete;
	/**
	 * Valor Total do Seguro
	 *
	 * @var decimal
	 */
	public $vSeg;
	/**
	 * Valor do Desconto
	 *
	 * @var decimal
	 */
	public $vDesc;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vOutro;
	/**
	 * Indica se valor do Item (vProd) entra no valor total da NF-e (vProd)
	 *
	 * @var decimal
	 */
	public $indTot;
	/**
	 * Código do produto conforme informado na Nota Fiscal.
	 *
	 * @var string
	 */
	public $cProdOrig;
	/**
	 * Descrição original do produto conforme informado na Nota Fiscal.
	 *
	 * @var string
	 */
	public $xProdOrig;
	/**
	 * CMC Unitário
	 *
	 * @var decimal
	 */
	public $nCMCUnitario;
	/**
	 * CMC Total.
	 *
	 * @var decimal
	 */
	public $nCMCTotal;
}

/**
 * Informações de Integração dos itens da NF
 *
 * @pw_element integer $nCodProd Código do Produto
 * @pw_element string $cCodProdInt Código de Integração do produto.
 * @pw_element integer $nCodItem Código do item
 * @pw_element string $cCodItemInt Código de Integração do Item.
 * @pw_complex nfProdInt
 */
class nfProdInt{
	/**
	 * Código do Produto
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de Integração do produto.
	 *
	 * @var string
	 */
	public $cCodProdInt;
	/**
	 * Código do item
	 *
	 * @var integer
	 */
	public $nCodItem;
	/**
	 * Código de Integração do Item.
	 *
	 * @var string
	 */
	public $cCodItemInt;
}

/**
 * Grupo de Valores Totais referentes ao ICMS
 *
 * @pw_element decimal $vBC Valor da Retenção da Previdência Social
 * @pw_element decimal $vICMS Valor da Retenção da Previdência Social
 * @pw_element decimal $vBCST Valor da Retenção da Previdência Social
 * @pw_element decimal $vST Valor da Retenção da Previdência Social
 * @pw_element decimal $vProd Valor da Retenção da Previdência Social
 * @pw_element decimal $vFrete Valor da Retenção da Previdência Social
 * @pw_element decimal $vSeg Valor da Retenção da Previdência Social
 * @pw_element decimal $vDesc Valor da Retenção da Previdência Social
 * @pw_element decimal $vII Valor da Retenção da Previdência Social
 * @pw_element decimal $vIPI Valor da Retenção da Previdência Social
 * @pw_element decimal $vPIS Valor da Retenção da Previdência Social
 * @pw_element decimal $vCOFINS Valor da Retenção da Previdência Social
 * @pw_element decimal $vOutro Valor da Retenção da Previdência Social
 * @pw_element decimal $vNF Valor da Retenção da Previdência Social
 * @pw_element decimal $vTotTrib Valor aproximado total de tributos federais, estaduais e municipais
 * @pw_complex ICMSTot
 */
class ICMSTot{
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vBC;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vICMS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vBCST;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vST;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vProd;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vFrete;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vSeg;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vDesc;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vII;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vIPI;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vPIS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vCOFINS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vOutro;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vNF;
	/**
	 * Valor aproximado total de tributos federais, estaduais e municipais
	 *
	 * @var decimal
	 */
	public $vTotTrib;
}

/**
 * Identificação da NF-e
 *
 * @pw_element string $indPag Indicador da forma de pagamento:<BR>0 ? pagamento à vista;<BR>1 ? pagamento à prazo;<BR>2 - outros.
 * @pw_element string $mod Código do Modelo do Documento Fiscal:<BR>Utilizar o código 55 para identificação da NF-e, emitida em substituição ao modelo 1 ou 1A.
 * @pw_element string $serie Série do Documento Fiscal
 * @pw_element string $nNF Número do Documento Fiscal
 * @pw_element string $dEmi Data de emissão.
 * @pw_element string $hEmi Hora de Emissão.
 * @pw_element string $dSaiEnt Data de saida.
 * @pw_element string $hSaiEnt Hora de Saída ou da Entrada da Mercadoria/Produto
 * @pw_element string $tpNF Tipo de Operação: 0-entrada / 1-saída
 * @pw_element string $tpAmb Tipo de Ambiente = 1-Produção / 2-Homologação
 * @pw_element string $finNFe Finalidade de emissão da NFe: <BR>1 ? NF-e normal<BR>2 ? NF-e complementar<BR>3 ? NF-e de ajuste
 * @pw_element string $dReg Data de Registro.
 * @pw_element string $dCan Data de cancelamento.
 * @pw_element string $dInut Data de Inutilização.
 * @pw_complex ide
 */
class ide{
	/**
	 * Indicador da forma de pagamento:<BR>0 ? pagamento à vista;<BR>1 ? pagamento à prazo;<BR>2 - outros.
	 *
	 * @var string
	 */
	public $indPag;
	/**
	 * Código do Modelo do Documento Fiscal:<BR>Utilizar o código 55 para identificação da NF-e, emitida em substituição ao modelo 1 ou 1A.
	 *
	 * @var string
	 */
	public $mod;
	/**
	 * Série do Documento Fiscal
	 *
	 * @var string
	 */
	public $serie;
	/**
	 * Número do Documento Fiscal
	 *
	 * @var string
	 */
	public $nNF;
	/**
	 * Data de emissão.
	 *
	 * @var string
	 */
	public $dEmi;
	/**
	 * Hora de Emissão.
	 *
	 * @var string
	 */
	public $hEmi;
	/**
	 * Data de saida.
	 *
	 * @var string
	 */
	public $dSaiEnt;
	/**
	 * Hora de Saída ou da Entrada da Mercadoria/Produto
	 *
	 * @var string
	 */
	public $hSaiEnt;
	/**
	 * Tipo de Operação: 0-entrada / 1-saída
	 *
	 * @var string
	 */
	public $tpNF;
	/**
	 * Tipo de Ambiente = 1-Produção / 2-Homologação
	 *
	 * @var string
	 */
	public $tpAmb;
	/**
	 * Finalidade de emissão da NFe: <BR>1 ? NF-e normal<BR>2 ? NF-e complementar<BR>3 ? NF-e de ajuste
	 *
	 * @var string
	 */
	public $finNFe;
	/**
	 * Data de Registro.
	 *
	 * @var string
	 */
	public $dReg;
	/**
	 * Data de cancelamento.
	 *
	 * @var string
	 */
	public $dCan;
	/**
	 * Data de Inutilização.
	 *
	 * @var string
	 */
	public $dInut;
}

/**
 * Informações complementares.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hInc Hora da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uInc Usuário da Inclusão.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dAlt Data da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hAlt Hora da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uAlt Usuário da Alteração.<BR>Preenchimento automático - Não informar.
 * @pw_element string $cImpAPI Importado pela API.<BR>Preenchimento automático - Não informar.
 * @pw_complex info
 */
class info{
	/**
	 * Data da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Grupo de Valores Totais referentes ao ISSQN
 *
 * @pw_element decimal $vServ Valor da Retenção da Previdência Social
 * @pw_element decimal $vBC Valor da Retenção da Previdência Social
 * @pw_element decimal $vISS Valor da Retenção da Previdência Social
 * @pw_element decimal $vPIS Valor da Retenção da Previdência Social
 * @pw_element decimal $vCOFINS Valor da Retenção da Previdência Social
 * @pw_complex ISSQNtot
 */
class ISSQNtot{
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vServ;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vBC;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vISS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vPIS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vCOFINS;
}

/**
 * Dados da Nota Fiscal
 *
 * @pw_element ide $ide Identificação da NF-e
 * @pw_element nfEmitInt $nfEmitInt Dados da Integração do Emitente
 * @pw_element nfDestInt $nfDestInt Dados de Integração do Destinatário da Nota Fiscal
 * @pw_element detArray $det Detalhes dos itens da Nota Fiscal.&nbsp;
 * @pw_element total $total Total da Nota Fiscal
 * @pw_element info $info Informações complementares.
 * @pw_element compl $compl Dados complementares da NF&nbsp;
 * @pw_element titulosArray $titulos Titulos gerados para a nota fiscal.
 * @pw_element pedido $pedido Dados do pedido.
 * @pw_complex nfCadastro
 */
class nfCadastro{
	/**
	 * Identificação da NF-e
	 *
	 * @var ide
	 */
	public $ide;
	/**
	 * Dados da Integração do Emitente
	 *
	 * @var nfEmitInt
	 */
	public $nfEmitInt;
	/**
	 * Dados de Integração do Destinatário da Nota Fiscal
	 *
	 * @var nfDestInt
	 */
	public $nfDestInt;
	/**
	 * Detalhes dos itens da Nota Fiscal.&nbsp;
	 *
	 * @var detArray
	 */
	public $det;
	/**
	 * Total da Nota Fiscal
	 *
	 * @var total
	 */
	public $total;
	/**
	 * Informações complementares.
	 *
	 * @var info
	 */
	public $info;
	/**
	 * Dados complementares da NF&nbsp;
	 *
	 * @var compl
	 */
	public $compl;
	/**
	 * Titulos gerados para a nota fiscal.
	 *
	 * @var titulosArray
	 */
	public $titulos;
	/**
	 * Dados do pedido.
	 *
	 * @var pedido
	 */
	public $pedido;
}


/**
 * Dados da Integração do Emitente
 *
 * @pw_element integer $nCodEmp Código da Empresa
 * @pw_element string $cCodEmpInt Código de integração da empresa.
 * @pw_complex nfEmitInt
 */
class nfEmitInt{
	/**
	 * Código da Empresa
	 *
	 * @var integer
	 */
	public $nCodEmp;
	/**
	 * Código de integração da empresa.
	 *
	 * @var string
	 */
	public $cCodEmpInt;
}

/**
 * Dados de Integração do Destinatário da Nota Fiscal
 *
 * @pw_element integer $nCodCli Código do cliente
 * @pw_element string $cCodCliInt Código de integração do cliente Fornecedor.&nbsp;
 * @pw_complex nfDestInt
 */
class nfDestInt{
	/**
	 * Código do cliente
	 *
	 * @var integer
	 */
	public $nCodCli;
	/**
	 * Código de integração do cliente Fornecedor.&nbsp;
	 *
	 * @var string
	 */
	public $cCodCliInt;
}

/**
 * Total da Nota Fiscal
 *
 * @pw_element ICMSTot $ICMSTot Grupo de Valores Totais referentes ao ICMS
 * @pw_element ISSQNtot $ISSQNtot Grupo de Valores Totais referentes ao ISSQN
 * @pw_element retTrib $retTrib Grupo de Retenções de Tributos
 * @pw_complex total
 */
class total{
	/**
	 * Grupo de Valores Totais referentes ao ICMS
	 *
	 * @var ICMSTot
	 */
	public $ICMSTot;
	/**
	 * Grupo de Valores Totais referentes ao ISSQN
	 *
	 * @var ISSQNtot
	 */
	public $ISSQNtot;
	/**
	 * Grupo de Retenções de Tributos
	 *
	 * @var retTrib
	 */
	public $retTrib;
}

/**
 * Titulos gerados para a nota fiscal.
 *
 * @pw_element integer $nCodTitulo Código do titulo.<BR>(Gerado internamente, não é visualizado na tela)
 * @pw_element string $cCodIntTitulo Código de integração do título.<BR>(Utilizado em títulos criados via API, não é visualizado na tela)
 * @pw_element string $cNumTitulo Número do título.<BR>(Informado pelo usuário / visualizado na tela)
 * @pw_element string $dDtEmissao Data de emissão do título.
 * @pw_element string $dDtVenc Data de vencimento do título.<BR>
 * @pw_element string $dDtPrevisao Data de previsão de Pagamento/Recebimento.
 * @pw_element decimal $nValorTitulo Valor do título.
 * @pw_element string $cCodCateg Código da Categoria.
 * @pw_element string $dReg Data de Registro.
 * @pw_element integer $nParcela Número da parcela.
 * @pw_element integer $nTotParc Número total de parcelas
 * @pw_element integer $nCodProjeto Código do Projeto
 * @pw_element integer $nCodVendedor Código do Vendedor
 * @pw_element integer $nCodComprador Número do Comprador
 * @pw_element integer $nCodTitRepet Código do título da repetição.<BR>
 * @pw_complex titulos
 */
class titulos{
	/**
	 * Código do titulo.<BR>(Gerado internamente, não é visualizado na tela)
	 *
	 * @var integer
	 */
	public $nCodTitulo;
	/**
	 * Código de integração do título.<BR>(Utilizado em títulos criados via API, não é visualizado na tela)
	 *
	 * @var string
	 */
	public $cCodIntTitulo;
	/**
	 * Número do título.<BR>(Informado pelo usuário / visualizado na tela)
	 *
	 * @var string
	 */
	public $cNumTitulo;
	/**
	 * Data de emissão do título.
	 *
	 * @var string
	 */
	public $dDtEmissao;
	/**
	 * Data de vencimento do título.<BR>
	 *
	 * @var string
	 */
	public $dDtVenc;
	/**
	 * Data de previsão de Pagamento/Recebimento.
	 *
	 * @var string
	 */
	public $dDtPrevisao;
	/**
	 * Valor do título.
	 *
	 * @var decimal
	 */
	public $nValorTitulo;
	/**
	 * Código da Categoria.
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Data de Registro.
	 *
	 * @var string
	 */
	public $dReg;
	/**
	 * Número da parcela.
	 *
	 * @var integer
	 */
	public $nParcela;
	/**
	 * Número total de parcelas
	 *
	 * @var integer
	 */
	public $nTotParc;
	/**
	 * Código do Projeto
	 *
	 * @var integer
	 */
	public $nCodProjeto;
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $nCodVendedor;
	/**
	 * Número do Comprador
	 *
	 * @var integer
	 */
	public $nCodComprador;
	/**
	 * Código do título da repetição.<BR>
	 *
	 * @var integer
	 */
	public $nCodTitRepet;
}


/**
 * Dados do pedido.
 *
 * @pw_element string $cNumPedido Número do Pedido do Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dIncPedido Data da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hIncPedido Hora da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uIncPedido Usuário da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dAltPedido Data da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hAltPedido Hora da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uAltPedido Usuário da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $cCancelado Indica que o Pedido de Venda foi cancelado.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dCanPedido Data de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hCanPedido Hora de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uCanPedido Usuário de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $cDevolvido Indica que o Pedido de Venda foi devolvido.<BR>Preenchimento automático - Não informar.
 * @pw_element string $cDevParcial Indica que o Pedido de Venda se foi uma devolução parcial.<BR>Preenchimento automático - Não informar.
 * @pw_element string $dDevPedido Data de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $hDevPedido Hora de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_element string $uDevPedido Usuário de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
 * @pw_complex pedido
 */
class pedido_{
	/**
	 * Número do Pedido do Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cNumPedido;
	/**
	 * Data da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dIncPedido;
	/**
	 * Hora da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hIncPedido;
	/**
	 * Usuário da Inclusão do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uIncPedido;
	/**
	 * Data da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dAltPedido;
	/**
	 * Hora da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hAltPedido;
	/**
	 * Usuário da Alteração do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uAltPedido;
	/**
	 * Indica que o Pedido de Venda foi cancelado.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cCancelado;
	/**
	 * Data de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dCanPedido;
	/**
	 * Hora de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hCanPedido;
	/**
	 * Usuário de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uCanPedido;
	/**
	 * Indica que o Pedido de Venda foi devolvido.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cDevolvido;
	/**
	 * Indica que o Pedido de Venda se foi uma devolução parcial.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $cDevParcial;
	/**
	 * Data de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $dDevPedido;
	/**
	 * Hora de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $hDevPedido;
	/**
	 * Usuário de Cancelamento do Pedido de Venda.<BR>Preenchimento automático - Não informar.
	 *
	 * @var string
	 */
	public $uDevPedido;
}

/**
 * Chave de pesquisa da Nota Fiscal
 *
 * @pw_element string $cCodNFInt Codigo de Integração da NF
 * @pw_element integer $nCodNF Código da Nota Fiscal.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element string $nNF Número do Documento Fiscal
 * @pw_element string $serie Série do Documento Fiscal
 * @pw_element string $dEmi Data de emissão.
 * @pw_element string $tpNF Tipo de Operação: 0-entrada / 1-saída
 * @pw_element string $cChaveNFe Chave da NF-e
 * @pw_element integer $nIdPedido Código de identificação do pedido.<BR>Interno, utilizando apenas nas APIs.
 * @pw_element string $cDetalhesPedido Exibe os detalhes do pedido que originou a Nota Fiscal.<BR><BR>Preecher com "S" ou "N".<BR>
 * @pw_complex nfChave
 */
class nfChave{
	/**
	 * Codigo de Integração da NF
	 *
	 * @var string
	 */
	public $cCodNFInt;
	/**
	 * Código da Nota Fiscal.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nCodNF;
	/**
	 * Número do Documento Fiscal
	 *
	 * @var string
	 */
	public $nNF;
	/**
	 * Série do Documento Fiscal
	 *
	 * @var string
	 */
	public $serie;
	/**
	 * Data de emissão.
	 *
	 * @var string
	 */
	public $dEmi;
	/**
	 * Tipo de Operação: 0-entrada / 1-saída
	 *
	 * @var string
	 */
	public $tpNF;
	/**
	 * Chave da NF-e
	 *
	 * @var string
	 */
	public $cChaveNFe;
	/**
	 * Código de identificação do pedido.<BR>Interno, utilizando apenas nas APIs.
	 *
	 * @var integer
	 */
	public $nIdPedido;
	/**
	 * Exibe os detalhes do pedido que originou a Nota Fiscal.<BR><BR>Preecher com "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $cDetalhesPedido;
}

/**
 * Solicitação de Listagem de Notas Fiscais
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros por página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. <BR>O padrão é 'CODIGO'
 * @pw_element string $ordem_decrescente Ordem decrescente.
 * @pw_element string $filtrar_por_data_de Filtra os registros até a data especificada.
 * @pw_element string $filtrar_por_data_ate Filtra os registros até a data especificada.
 * @pw_element string $filtrar_apenas_inclusao Filtra os registros exibindos apenas os incluídos.
 * @pw_element string $filtrar_apenas_alteracao Filtra os registros exibindos apenas os alterados.
 * @pw_element string $dEmiInicial Data de emissão.
 * @pw_element string $hEmiInicial Hora de Emissão.
 * @pw_element string $dEmiFinal Data de emissão.
 * @pw_element string $hEmiFinal Hora de Emissão.
 * @pw_element string $dSaiEntInicial Data de saida.
 * @pw_element string $dSaiEntFinal Data de saida.
 * @pw_element string $dRegInicial Data de Registro.
 * @pw_element string $dRegFinal Data de Registro.
 * @pw_element string $dCanInicial Data de cancelamento.
 * @pw_element string $dCanFinal Data de cancelamento.
 * @pw_element string $dInutInicial Data de Inutilização.
 * @pw_element string $dInutFinal Data de Inutilização.
 * @pw_element string $tpNF Tipo de Operação: 0-entrada / 1-saída
 * @pw_element string $tpAmb Tipo de Ambiente = 1-Produção / 2-Homologação
 * @pw_element string $cDetalhesPedido Exibe os detalhes do pedido que originou a Nota Fiscal.<BR><BR>Preecher com "S" ou "N".<BR>
 * @pw_element string $ordem_descrescente DEPRECATED
 * @pw_complex nfListarRequest
 */
class nfListarRequest{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API.
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. <BR>O padrão é 'CODIGO'
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Ordem decrescente.
	 *
	 * @var string
	 */
	public $ordem_decrescente;
	/**
	 * Filtra os registros até a data especificada.
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Filtra os registros até a data especificada.
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtra os registros exibindos apenas os incluídos.
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtra os registros exibindos apenas os alterados.
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Data de emissão.
	 *
	 * @var string
	 */
	public $dEmiInicial;
	/**
	 * Hora de Emissão.
	 *
	 * @var string
	 */
	public $hEmiInicial;
	/**
	 * Data de emissão.
	 *
	 * @var string
	 */
	public $dEmiFinal;
	/**
	 * Hora de Emissão.
	 *
	 * @var string
	 */
	public $hEmiFinal;
	/**
	 * Data de saida.
	 *
	 * @var string
	 */
	public $dSaiEntInicial;
	/**
	 * Data de saida.
	 *
	 * @var string
	 */
	public $dSaiEntFinal;
	/**
	 * Data de Registro.
	 *
	 * @var string
	 */
	public $dRegInicial;
	/**
	 * Data de Registro.
	 *
	 * @var string
	 */
	public $dRegFinal;
	/**
	 * Data de cancelamento.
	 *
	 * @var string
	 */
	public $dCanInicial;
	/**
	 * Data de cancelamento.
	 *
	 * @var string
	 */
	public $dCanFinal;
	/**
	 * Data de Inutilização.
	 *
	 * @var string
	 */
	public $dInutInicial;
	/**
	 * Data de Inutilização.
	 *
	 * @var string
	 */
	public $dInutFinal;
	/**
	 * Tipo de Operação: 0-entrada / 1-saída
	 *
	 * @var string
	 */
	public $tpNF;
	/**
	 * Tipo de Ambiente = 1-Produção / 2-Homologação
	 *
	 * @var string
	 */
	public $tpAmb;
	/**
	 * Exibe os detalhes do pedido que originou a Nota Fiscal.<BR><BR>Preecher com "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $cDetalhesPedido;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $ordem_descrescente;
}

/**
 * Resposta da listagem de Notas Fiscais
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros por página.
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element nfCadastroArray $nfCadastro Dados da Nota Fiscal&nbsp;
 * @pw_complex nfListarResponse
 */
class nfListarResponse{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Total de páginas encontradas.
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros por página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * Total de registros encontrados.
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Dados da Nota Fiscal&nbsp;
	 *
	 * @var nfCadastroArray
	 */
	public $nfCadastro;
}

/**
 * Grupo de Retenções de Tributos
 *
 * @pw_element decimal $vRetPIS Valor da Retenção da Previdência Social
 * @pw_element decimal $vRetCOFINS Valor da Retenção da Previdência Social
 * @pw_element decimal $vRetCSLL Valor da Retenção da Previdência Social
 * @pw_element decimal $vBCIRRF Valor da Retenção da Previdência Social
 * @pw_element decimal $vIRRF Valor da Retenção da Previdência Social
 * @pw_element decimal $vBCRetPrev Valor da Retenção da Previdência Social
 * @pw_element decimal $vRetPrev Valor da Retenção da Previdência Social
 * @pw_complex retTrib
 */
class retTrib{
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vRetPIS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vRetCOFINS;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vRetCSLL;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vBCIRRF;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vIRRF;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vBCRetPrev;
	/**
	 * Valor da Retenção da Previdência Social
	 *
	 * @var decimal
	 */
	public $vRetPrev;
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