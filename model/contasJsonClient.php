<?php
/**
 * @service contasJsonClient
 * @author omie
 */
class contasJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/crm/contas/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/crm/contas/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
            //print_r([$method,$param]);die;
		$call=Array(
			"call"=>$method,
			"param"=>$param,
			"app_key"=>OMIE_APP_KEY,
			"app_secret"=>OMIE_APP_SECRET
		);
                //print_r((json_encode($call)));die;
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * @param cadastros $cadastros Lista os cadastros encontrados.
	 * @return CRM_CONTAS_RESPOSTA Status da Comunicação
	 */
	public function IncluirConta($cadastros){
		return self::_Call('IncluirConta',Array(
			$cadastros
		));
	}

	/**
	 * @param cadastros $cadastros Lista os cadastros encontrados.
	 * @return CRM_CONTAS_RESPOSTA Status da Comunicação
	 */
	public function AlterarConta($cadastros){
		return self::_Call('AlterarConta',Array(
			$cadastros
		));
	}

	/**
	 * @param CRM_CONTAS_PESQUISA $CRM_CONTAS_PESQUISA Pesquisa da conta
	 * @return CRM_CONTAS_RESPOSTA Status da Comunicação
	 */
	public function ExcluirConta($CRM_CONTAS_PESQUISA){
		return self::_Call('ExcluirConta',Array(
			$CRM_CONTAS_PESQUISA
		));
	}

	/**
	 * @param CRM_CONTAS_PESQUISA $CRM_CONTAS_PESQUISA Pesquisa da conta
	 * @return cadastros Lista os cadastros encontrados.
	 */
	public function ConsultarConta($CRM_CONTAS_PESQUISA){
		return self::_Call('ConsultarConta',Array(
			$CRM_CONTAS_PESQUISA
		));
	}

	/**
	 * Lista as contas do CRM.
	 *
	 * @param contaListarRequest $contaListarRequest Solicitação da listagem de Contas.
	 * @return contaListarResponse Resposta da solicitação da listagem de Contas.
	 */
	public function ListarContas($contaListarRequest){
		return self::_Call('ListarContas',Array(
			$contaListarRequest
		));
	}

	/**
	 * @param cadastros $cadastros Lista os cadastros encontrados.
	 * @return CRM_CONTAS_RESPOSTA Status da Comunicação
	 */
	public function UpsertConta($cadastros){
		return self::_Call('UpsertConta',Array(
			$cadastros
		));
	}
}

/**
 * Identificação da Conta
 *
 * @pw_element integer $nCod Código da Conta
 * @pw_element string $cCodInt Código de Integração&nbsp;
 * @pw_element string $cNome Nome da Conta&nbsp;
 * @pw_element string $cDoc Documento CNPJ / CPF.
 * @pw_element integer $nCodVend Código do Vendedor
 * @pw_element integer $nCodVert Código da Vertical&nbsp;
 * @pw_element integer $nCodTelemkt Código do Telemarketing
 * @pw_element string $dDtReg Data de Registro&nbsp;
 * @pw_element string $dDtValid Data de Validade da Reserva
 * @pw_element string $cObs Observação&nbsp;
 * @pw_complex identificacao
 */
class identificacao{
	/**
	 * Código da Conta
	 *
	 * @var integer
	 */
	public $nCod;
	/**
	 * Código de Integração&nbsp;
	 *
	 * @var string
	 */
	public $cCodInt;
	/**
	 * Nome da Conta&nbsp;
	 *
	 * @var string
	 */
	public $cNome;
	/**
	 * Documento CNPJ / CPF.
	 *
	 * @var string
	 */
	public $cDoc;
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $nCodVend;
	/**
	 * Código da Vertical&nbsp;
	 *
	 * @var integer
	 */
	public $nCodVert;
	/**
	 * Código do Telemarketing
	 *
	 * @var integer
	 */
	public $nCodTelemkt;
	/**
	 * Data de Registro&nbsp;
	 *
	 * @var string
	 */
	public $dDtReg;
	/**
	 * Data de Validade da Reserva
	 *
	 * @var string
	 */
	public $dDtValid;
	/**
	 * Observação&nbsp;
	 *
	 * @var string
	 */
	public $cObs;
}

/**
 * Endereço da Conta
 *
 * @pw_element string $cEndereco Endereço
 * @pw_element string $cCompl Complemento do Endereço
 * @pw_element string $cCEP CEP
 * @pw_element string $cBairro Bairro&nbsp;
 * @pw_element string $cCidade Cidade&nbsp;
 * @pw_element string $cUF Estado
 * @pw_element string $cPais País
 * @pw_complex endereco
 */
class endereco{
	/**
	 * Endereço
	 *
	 * @var string
	 */
	public $cEndereco;
	/**
	 * Complemento do Endereço
	 *
	 * @var string
	 */
	public $cCompl;
	/**
	 * CEP
	 *
	 * @var string
	 */
	public $cCEP;
	/**
	 * Bairro&nbsp;
	 *
	 * @var string
	 */
	public $cBairro;
	/**
	 * Cidade&nbsp;
	 *
	 * @var string
	 */
	public $cCidade;
	/**
	 * Estado
	 *
	 * @var string
	 */
	public $cUF;
	/**
	 * País
	 *
	 * @var string
	 */
	public $cPais;
}

/**
 * Telefones e Email
 *
 * @pw_element string $cDDDTel DDD do Telefone
 * @pw_element string $cNumTel Número do Telefone
 * @pw_element string $cDDDFax DDD do Fax&nbsp;
 * @pw_element string $cNumFax Número do Fax
 * @pw_element string $cEmail E-Mail
 * @pw_element string $cWebsite Website
 * @pw_complex telefone_email
 */
class telefone_email{
	/**
	 * DDD do Telefone
	 *
	 * @var string
	 */
	public $cDDDTel;
	/**
	 * Número do Telefone
	 *
	 * @var string
	 */
	public $cNumTel;
	/**
	 * DDD do Fax&nbsp;
	 *
	 * @var string
	 */
	public $cDDDFax;
	/**
	 * Número do Fax
	 *
	 * @var string
	 */
	public $cNumFax;
	/**
	 * E-Mail
	 *
	 * @var string
	 */
	public $cEmail;
	/**
	 * Website
	 *
	 * @var string
	 */
	public $cWebsite;
}

/**
 * Lista os cadastros encontrados.
 *
 * @pw_element identificacao $identificacao Identificação da Conta
 * @pw_element endereco $endereco Endereço da Conta
 * @pw_element telefone_email $telefone_email Telefones e Email
 * @pw_element informacoesAdicionais $informacoesAdicionais Informações Adicionais
 * @pw_complex cadastros
 */
class cadastros{
	/**
	 * Identificação da Conta
	 *
	 * @var identificacao
	 */
	public $identificacao;
	/**
	 * Endereço da Conta
	 *
	 * @var endereco
	 */
	public $endereco;
	/**
	 * Telefones e Email
	 *
	 * @var telefone_email
	 */
	public $telefone_email;
	/**
	 * Informações Adicionais
	 *
	 * @var informacoesAdicionais
	 */
	public $informacoesAdicionais;
}


/**
 * Informações Adicionais
 *
 * @pw_element integer $nNumFunc Número de Funcionários
 * @pw_element decimal $nFaixaFat Faixa de Faturamento
 * @pw_complex informacoesAdicionais
 */
class informacoesAdicionais{
	/**
	 * Número de Funcionários
	 *
	 * @var integer
	 */
	public $nNumFunc;
	/**
	 * Faixa de Faturamento
	 *
	 * @var decimal
	 */
	public $nFaixaFat;
}

/**
 * Pesquisa da conta
 *
 * @pw_element integer $nCod Código da Conta
 * @pw_element string $cCodInt Código de Integração&nbsp;
 * @pw_complex CRM_CONTAS_PESQUISA
 */
class CRM_CONTAS_PESQUISA{
	/**
	 * Código da Conta
	 *
	 * @var integer
	 */
	public $nCod;
	/**
	 * Código de Integração&nbsp;
	 *
	 * @var string
	 */
	public $cCodInt;
}

/**
 * Status da Comunicação
 *
 * @pw_element integer $nCod Código da Conta
 * @pw_element string $cCodInt Código de Integração&nbsp;
 * @pw_element string $cCodStatus Código do Status
 * @pw_element string $cDesStatus Descrição do Status
 * @pw_complex CRM_CONTAS_RESPOSTA
 */
class CRM_CONTAS_RESPOSTA{
	/**
	 * Código da Conta
	 *
	 * @var integer
	 */
	public $nCod;
	/**
	 * Código de Integração&nbsp;
	 *
	 * @var string
	 */
	public $cCodInt;
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
 * Solicitação da listagem de Contas.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_complex contaListarRequest
 */
class contaListarRequest{
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
 * Resposta da solicitação da listagem de Contas.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element cadastrosArray $cadastros Lista os cadastros encontrados.
 * @pw_complex contaListarResponse
 */
class contaListarResponse{
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
/*
if (!class_exists('omie_fail')) {
class omie_fail{
	public $code;
	public $description;
	public $referer;
	public $fatal;
}
}
*/