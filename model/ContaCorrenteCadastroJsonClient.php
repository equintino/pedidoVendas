<?php
/**
 * @service ContaCorrenteCadastroJsonClient
 * @author omie
 */
class ContaCorrenteCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/contacorrente/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/contacorrente/';

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
	 * Inclui uma conta corrente
	 *
	 * @param fin_conta_corrente_cadastro $fin_conta_corrente_cadastro Lista de Contas Correntes
	 * @return fin_conta_corrente_cadastro_response Response do cadastro do conta corrente.
	 */
	public function IncluirContaCorrente($fin_conta_corrente_cadastro){
		return self::_Call('IncluirContaCorrente',Array(
			$fin_conta_corrente_cadastro
		));
	}

	/**
	 * Altera a Conta Corrente
	 *
	 * @param fin_conta_corrente_cadastro $fin_conta_corrente_cadastro Lista de Contas Correntes
	 * @return fin_conta_corrente_cadastro_response Response do cadastro do conta corrente.
	 */
	public function AlterarContaCorrente($fin_conta_corrente_cadastro){
		return self::_Call('AlterarContaCorrente',Array(
			$fin_conta_corrente_cadastro
		));
	}

	/**
	 * Excluir a Conta Corrente
	 *
	 * @param fin_conta_corrente_chave $fin_conta_corrente_chave Chave de pesquisa da Conta Corrente
	 * @return fin_conta_corrente_cadastro_response Response do cadastro do conta corrente.
	 */
	public function ExcluirContaCorrente($fin_conta_corrente_chave){
		return self::_Call('ExcluirContaCorrente',Array(
			$fin_conta_corrente_chave
		));
	}

	/**
	 * Realiza a consulta de uma conta corrente
	 *
	 * @param fin_conta_corrente_chave $fin_conta_corrente_chave Chave de pesquisa da Conta Corrente
	 * @return fin_conta_corrente_cadastro Lista de Contas Correntes
	 */
	public function ConsultarContaCorrente($fin_conta_corrente_chave){
		return self::_Call('ConsultarContaCorrente',Array(
			$fin_conta_corrente_chave
		));
	}

	/**
	 * Pesquisa as contas correntes cadastradas.
	 *
	 * @param fin_conta_corrente_pesquisar $fin_conta_corrente_pesquisar Retorna lista de contas correntes cadastradas no Omie.
	 * @return fin_conta_corrente_pesquisar_resposta Lista de Contas Correntes encontradas.
	 */
	public function PesquisarContaCorrente($fin_conta_corrente_pesquisar){
		return self::_Call('PesquisarContaCorrente',Array(
			$fin_conta_corrente_pesquisar
		));
	}

	/**
	 * Upsert da Conta Corrente
	 *
	 * @param fin_conta_corrente_cadastro $fin_conta_corrente_cadastro Lista de Contas Correntes
	 * @return fin_conta_corrente_cadastro_response Response do cadastro do conta corrente.
	 */
	public function UpsertContaCorrente($fin_conta_corrente_cadastro){
		return self::_Call('UpsertContaCorrente',Array(
			$fin_conta_corrente_cadastro
		));
	}

	/**
	 * Upsert por lote de Conta Corrente
	 *
	 * @param fin_conta_corrente_lote_request $fin_conta_corrente_lote_request Request do Lote da Conta Corrente
	 * @return fin_conta_corrente_lote_response Response do conta corrente
	 */
	public function UpsertContaCorrentePorLote($fin_conta_corrente_lote_request){
		return self::_Call('UpsertContaCorrentePorLote',Array(
			$fin_conta_corrente_lote_request
		));
	}
}

/**
 * Lista de Contas Correntes
 *
 * @pw_element integer $nCodCC Código da conta corrente.
 * @pw_element string $cCodCCInt Código de Integração do parceiro.
 * @pw_element string $tipo_conta_corrente Código da conta corrente no Omie.
 * @pw_element string $codigo_banco Código do Banco / Instituição Financeira
 * @pw_element string $descricao Descrição da conta corrente.
 * @pw_element string $codigo_agencia Código da Agência da Conta Corrente
 * @pw_element string $numero_conta_corrente Número da Conta Corrente
 * @pw_element decimal $saldo_inicial Saldo Inicial da Conta Corrente
 * @pw_element string $saldo_data Data do Saldo Inicial da Conta Corrente
 * @pw_element decimal $valor_limite Valor do Limite do Crédito
 * @pw_element string $nao_fluxo Não exibir no Fluxo de Caixa
 * @pw_element string $nao_resumo Não exibir no Resumo de Finanças
 * @pw_element string $observacao Observação
 * @pw_element string $cobr_sn Indica se realiza Cobrança Bancária para a conta corrente [S/N]
 * @pw_element decimal $per_juros Percentual de Juros ao Mês
 * @pw_element decimal $per_multa Percentual de Multa
 * @pw_element string $bol_instr1 Mensagem de Instrução do Boleto - Linha 1
 * @pw_element string $bol_instr2 Mensagem de Instrução do Boleto - Linha 2
 * @pw_element string $bol_instr3 Mensagem de Instrução do Boleto - Linha 3
 * @pw_element string $bol_instr4 Mensagem de Instrução do Boleto - Linha 4
 * @pw_element string $bol_sn Indica se emite Boletos de Cobrança [S/N]
 * @pw_element string $cnab_esp Espécie padrão para a Remessa de Cobrança
 * @pw_element string $cobr_esp Espécie padrão para o Boleto de Cobrança
 * @pw_element integer $dias_rcomp Dias para Compensação dos Recebimentos
 * @pw_element string $modalidade Modalidade da Cobrança
 * @pw_element string $cancinstr Código de Instrução de Cancelamento, Baixa ou Devolução
 * @pw_element string $pdv_enviar Utiliza a Conta Corrente no OmiePDV
 * @pw_element string $pdv_sincr_analitica Sincronização Analítica para a Conta Corrente (Venda a Venda)
 * @pw_element integer $pdv_dias_venc Dias para Vencimento
 * @pw_element integer $pdv_num_parcelas Número de Parcelas
 * @pw_element integer $pdv_tipo_tef Tipo de TEF: 1-Nenhum 3-Paygo X-SITEF
 * @pw_element integer $pdv_cod_adm Código da Adminstradora de Cartão
 * @pw_element integer $pdv_limite_pacelas Limite máximo de parcelas
 * @pw_element decimal $pdv_taxa_loja Taxa de Juros da Loja
 * @pw_element decimal $pdv_taxa_adm Taxa da operadora
 * @pw_element string $pdv_categoria Código da Categoria para o PDV.
 * @pw_element string $nome_gerente Nome do gerente da conta corrente.
 * @pw_element string $ddd DDD do Telefone de Contato do Gerente da Agência
 * @pw_element string $telefone Telefone de Contato do Gerente da Agência
 * @pw_element string $email E-mail do Gerente da Conta Corrente
 * @pw_element string $endereco Endereço da Agência
 * @pw_element string $numero Número do Endereço
 * @pw_element string $bairro Bairro
 * @pw_element string $complemento Complemento do Número do Endereço
 * @pw_element string $estado Estado da Agência
 * @pw_element string $cidade Cidade da Agência
 * @pw_element string $cep CEP da Agência
 * @pw_element string $codigo_pais Código do País
 * @pw_element string $data_inc Data de Inclusão
 * @pw_element string $hora_inc Hora de Inclusão
 * @pw_element string $user_inc Usuário da Inclusão
 * @pw_element string $data_alt Data de alteração
 * @pw_element string $hora_alt Hora de Alteração
 * @pw_element string $user_alt Usuário de Alteração
 * @pw_element string $importado_api Registro importado pela API
 * @pw_element string $bloqueado Registro Bloqueado pela API&nbsp;
 * @pw_complex fin_conta_corrente_cadastro
 */
class fin_conta_corrente_cadastro{
	/**
	 * Código da conta corrente.
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de Integração do parceiro.
	 *
	 * @var string
	 */
	public $cCodCCInt;
	/**
	 * Código da conta corrente no Omie.
	 *
	 * @var string
	 */
	public $tipo_conta_corrente;
	/**
	 * Código do Banco / Instituição Financeira
	 *
	 * @var string
	 */
	public $codigo_banco;
	/**
	 * Descrição da conta corrente.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Código da Agência da Conta Corrente
	 *
	 * @var string
	 */
	public $codigo_agencia;
	/**
	 * Número da Conta Corrente
	 *
	 * @var string
	 */
	public $numero_conta_corrente;
	/**
	 * Saldo Inicial da Conta Corrente
	 *
	 * @var decimal
	 */
	public $saldo_inicial;
	/**
	 * Data do Saldo Inicial da Conta Corrente
	 *
	 * @var string
	 */
	public $saldo_data;
	/**
	 * Valor do Limite do Crédito
	 *
	 * @var decimal
	 */
	public $valor_limite;
	/**
	 * Não exibir no Fluxo de Caixa
	 *
	 * @var string
	 */
	public $nao_fluxo;
	/**
	 * Não exibir no Resumo de Finanças
	 *
	 * @var string
	 */
	public $nao_resumo;
	/**
	 * Observação
	 *
	 * @var string
	 */
	public $observacao;
	/**
	 * Indica se realiza Cobrança Bancária para a conta corrente [S/N]
	 *
	 * @var string
	 */
	public $cobr_sn;
	/**
	 * Percentual de Juros ao Mês
	 *
	 * @var decimal
	 */
	public $per_juros;
	/**
	 * Percentual de Multa
	 *
	 * @var decimal
	 */
	public $per_multa;
	/**
	 * Mensagem de Instrução do Boleto - Linha 1
	 *
	 * @var string
	 */
	public $bol_instr1;
	/**
	 * Mensagem de Instrução do Boleto - Linha 2
	 *
	 * @var string
	 */
	public $bol_instr2;
	/**
	 * Mensagem de Instrução do Boleto - Linha 3
	 *
	 * @var string
	 */
	public $bol_instr3;
	/**
	 * Mensagem de Instrução do Boleto - Linha 4
	 *
	 * @var string
	 */
	public $bol_instr4;
	/**
	 * Indica se emite Boletos de Cobrança [S/N]
	 *
	 * @var string
	 */
	public $bol_sn;
	/**
	 * Espécie padrão para a Remessa de Cobrança
	 *
	 * @var string
	 */
	public $cnab_esp;
	/**
	 * Espécie padrão para o Boleto de Cobrança
	 *
	 * @var string
	 */
	public $cobr_esp;
	/**
	 * Dias para Compensação dos Recebimentos
	 *
	 * @var integer
	 */
	public $dias_rcomp;
	/**
	 * Modalidade da Cobrança
	 *
	 * @var string
	 */
	public $modalidade;
	/**
	 * Código de Instrução de Cancelamento, Baixa ou Devolução
	 *
	 * @var string
	 */
	public $cancinstr;
	/**
	 * Utiliza a Conta Corrente no OmiePDV
	 *
	 * @var string
	 */
	public $pdv_enviar;
	/**
	 * Sincronização Analítica para a Conta Corrente (Venda a Venda)
	 *
	 * @var string
	 */
	public $pdv_sincr_analitica;
	/**
	 * Dias para Vencimento
	 *
	 * @var integer
	 */
	public $pdv_dias_venc;
	/**
	 * Número de Parcelas
	 *
	 * @var integer
	 */
	public $pdv_num_parcelas;
	/**
	 * Tipo de TEF: 1-Nenhum 3-Paygo X-SITEF
	 *
	 * @var integer
	 */
	public $pdv_tipo_tef;
	/**
	 * Código da Adminstradora de Cartão
	 *
	 * @var integer
	 */
	public $pdv_cod_adm;
	/**
	 * Limite máximo de parcelas
	 *
	 * @var integer
	 */
	public $pdv_limite_pacelas;
	/**
	 * Taxa de Juros da Loja
	 *
	 * @var decimal
	 */
	public $pdv_taxa_loja;
	/**
	 * Taxa da operadora
	 *
	 * @var decimal
	 */
	public $pdv_taxa_adm;
	/**
	 * Código da Categoria para o PDV.
	 *
	 * @var string
	 */
	public $pdv_categoria;
	/**
	 * Nome do gerente da conta corrente.
	 *
	 * @var string
	 */
	public $nome_gerente;
	/**
	 * DDD do Telefone de Contato do Gerente da Agência
	 *
	 * @var string
	 */
	public $ddd;
	/**
	 * Telefone de Contato do Gerente da Agência
	 *
	 * @var string
	 */
	public $telefone;
	/**
	 * E-mail do Gerente da Conta Corrente
	 *
	 * @var string
	 */
	public $email;
	/**
	 * Endereço da Agência
	 *
	 * @var string
	 */
	public $endereco;
	/**
	 * Número do Endereço
	 *
	 * @var string
	 */
	public $numero;
	/**
	 * Bairro
	 *
	 * @var string
	 */
	public $bairro;
	/**
	 * Complemento do Número do Endereço
	 *
	 * @var string
	 */
	public $complemento;
	/**
	 * Estado da Agência
	 *
	 * @var string
	 */
	public $estado;
	/**
	 * Cidade da Agência
	 *
	 * @var string
	 */
	public $cidade;
	/**
	 * CEP da Agência
	 *
	 * @var string
	 */
	public $cep;
	/**
	 * Código do País
	 *
	 * @var string
	 */
	public $codigo_pais;
	/**
	 * Data de Inclusão
	 *
	 * @var string
	 */
	public $data_inc;
	/**
	 * Hora de Inclusão
	 *
	 * @var string
	 */
	public $hora_inc;
	/**
	 * Usuário da Inclusão
	 *
	 * @var string
	 */
	public $user_inc;
	/**
	 * Data de alteração
	 *
	 * @var string
	 */
	public $data_alt;
	/**
	 * Hora de Alteração
	 *
	 * @var string
	 */
	public $hora_alt;
	/**
	 * Usuário de Alteração
	 *
	 * @var string
	 */
	public $user_alt;
	/**
	 * Registro importado pela API
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * Registro Bloqueado pela API&nbsp;
	 *
	 * @var string
	 */
	public $bloqueado;
}


/**
 * Retorna lista de contas correntes cadastradas no Omie.
 *
 * @pw_element integer $codigo Código da conta corrente.
 * @pw_element string $codigo_integracao Código de Integração do parceiro.
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros por página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. <BR>O padrão é 'CODIGO'
 * @pw_element string $ordem_descrescente Exibir em Ordem Crescente ou Decrescente
 * @pw_element string $filtrar_por_data_de Filtra os registros até a data especificada.
 * @pw_element string $filtrar_por_data_ate Filtra os registros até a data especificada.
 * @pw_element string $filtrar_apenas_inclusao Filtra os registros exibindos apenas os incluídos.
 * @pw_element string $filtrar_apenas_alteracao Filtra os registros exibindos apenas os alterados.
 * @pw_complex fin_conta_corrente_pesquisar
 */
class fin_conta_corrente_pesquisar{
	/**
	 * Código da conta corrente.
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do parceiro.
	 *
	 * @var string
	 */
	public $codigo_integracao;
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
	 * Exibir em Ordem Crescente ou Decrescente
	 *
	 * @var string
	 */
	public $ordem_descrescente;
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
}

/**
 * Lista de contas correntes
 *
 * @pw_element integer $nCodCC Código da conta corrente.
 * @pw_element string $cCodCCInt Código de Integração do parceiro.
 * @pw_element string $descricao Descrição da conta corrente.
 * @pw_element string $codigo_banco Código do Banco / Instituição Financeira
 * @pw_element string $codigo_agencia Código da Agência da Conta Corrente
 * @pw_element string $conta_corrente Número da Conta Corrente
 * @pw_element string $nome_gerente Nome do gerente da conta corrente.
 * @pw_element string $tipo Código da conta corrente no Omie.
 * @pw_element string $tipo_comunicacao Tipo de comunicação&nbsp;
 * @pw_element string $cSincrAnalitica Sincronização Analítica para a Conta Corrente (Venda a Venda)
 * @pw_element integer $nTpTef Tipo de TEF: 1-Nenhum 3-Paygo X-SITEF
 * @pw_element decimal $nTaxaAdm Taxa da operadora
 * @pw_element integer $nDiasVenc Dias para Vencimento
 * @pw_element integer $nNumParc Número de Parcelas
 * @pw_element integer $nCodAdm Código da Adminstradora de Cartão
 * @pw_element string $cUtilPDV Utiliza a Conta Corrente no OmiePDV
 * @pw_element string $cCategoria Código da Categoria para o PDV.
 * @pw_element string $cModalidade Modalidade da Cobrança
 * @pw_element decimal $saldo_inicial Saldo Inicial da Conta Corrente
 * @pw_element string $saldo_data Data do Saldo Inicial da Conta Corrente
 * @pw_element decimal $valor_limite Valor do Limite do Crédito
 * @pw_complex conta_corrente_lista
 */
class conta_corrente_lista{
	/**
	 * Código da conta corrente.
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de Integração do parceiro.
	 *
	 * @var string
	 */
	public $cCodCCInt;
	/**
	 * Descrição da conta corrente.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Código do Banco / Instituição Financeira
	 *
	 * @var string
	 */
	public $codigo_banco;
	/**
	 * Código da Agência da Conta Corrente
	 *
	 * @var string
	 */
	public $codigo_agencia;
	/**
	 * Número da Conta Corrente
	 *
	 * @var string
	 */
	public $conta_corrente;
	/**
	 * Nome do gerente da conta corrente.
	 *
	 * @var string
	 */
	public $nome_gerente;
	/**
	 * Código da conta corrente no Omie.
	 *
	 * @var string
	 */
	public $tipo;
	/**
	 * Tipo de comunicação&nbsp;
	 *
	 * @var string
	 */
	public $tipo_comunicacao;
	/**
	 * Sincronização Analítica para a Conta Corrente (Venda a Venda)
	 *
	 * @var string
	 */
	public $cSincrAnalitica;
	/**
	 * Tipo de TEF: 1-Nenhum 3-Paygo X-SITEF
	 *
	 * @var integer
	 */
	public $nTpTef;
	/**
	 * Taxa da operadora
	 *
	 * @var decimal
	 */
	public $nTaxaAdm;
	/**
	 * Dias para Vencimento
	 *
	 * @var integer
	 */
	public $nDiasVenc;
	/**
	 * Número de Parcelas
	 *
	 * @var integer
	 */
	public $nNumParc;
	/**
	 * Código da Adminstradora de Cartão
	 *
	 * @var integer
	 */
	public $nCodAdm;
	/**
	 * Utiliza a Conta Corrente no OmiePDV
	 *
	 * @var string
	 */
	public $cUtilPDV;
	/**
	 * Código da Categoria para o PDV.
	 *
	 * @var string
	 */
	public $cCategoria;
	/**
	 * Modalidade da Cobrança
	 *
	 * @var string
	 */
	public $cModalidade;
	/**
	 * Saldo Inicial da Conta Corrente
	 *
	 * @var decimal
	 */
	public $saldo_inicial;
	/**
	 * Data do Saldo Inicial da Conta Corrente
	 *
	 * @var string
	 */
	public $saldo_data;
	/**
	 * Valor do Limite do Crédito
	 *
	 * @var decimal
	 */
	public $valor_limite;
}


/**
 * Lista de Contas Correntes encontradas.
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros por página.
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element conta_corrente_listaArray $conta_corrente_lista Lista de contas correntes&nbsp;
 * @pw_complex fin_conta_corrente_pesquisar_resposta
 */
class fin_conta_corrente_pesquisar_resposta{
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
	 * Lista de contas correntes&nbsp;
	 *
	 * @var conta_corrente_listaArray
	 */
	public $conta_corrente_lista;
}

/**
 * Response do cadastro do conta corrente.
 *
 * @pw_element integer $nCodCC Código da conta corrente.
 * @pw_element string $cCodCCInt Código de Integração do parceiro.
 * @pw_element string $cCodStatus Código do Status
 * @pw_element string $cDesStatus Descrição do Status
 * @pw_complex fin_conta_corrente_cadastro_response
 */
class fin_conta_corrente_cadastro_response{
	/**
	 * Código da conta corrente.
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de Integração do parceiro.
	 *
	 * @var string
	 */
	public $cCodCCInt;
	/**
	 * Código do Status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do Status
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Request do Lote da Conta Corrente
 *
 * @pw_element integer $lote Identificação do Lote
 * @pw_element fin_conta_corrente_cadastroArray $fin_conta_corrente_cadastro Lista de Contas Correntes
 * @pw_complex fin_conta_corrente_lote_request
 */
class fin_conta_corrente_lote_request{
	/**
	 * Identificação do Lote
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Lista de Contas Correntes
	 *
	 * @var fin_conta_corrente_cadastroArray
	 */
	public $fin_conta_corrente_cadastro;
}

/**
 * Response do conta corrente
 *
 * @pw_element integer $lote Identificação do Lote
 * @pw_element string $cCodStatus Código do Status
 * @pw_element string $cDesStatus Descrição do Status
 * @pw_complex fin_conta_corrente_lote_response
 */
class fin_conta_corrente_lote_response{
	/**
	 * Identificação do Lote
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Código do Status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do Status
	 *
	 * @var string
	 */
	public $cDesStatus;
}

/**
 * Chave de pesquisa da Conta Corrente
 *
 * @pw_element integer $nCodCC Código da conta corrente.
 * @pw_element string $cCodCCInt Código de Integração do parceiro.
 * @pw_complex fin_conta_corrente_chave
 */
class fin_conta_corrente_chave{
	/**
	 * Código da conta corrente.
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de Integração do parceiro.
	 *
	 * @var string
	 */
	public $cCodCCInt;
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