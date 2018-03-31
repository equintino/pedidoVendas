<?php
/**
 * @service VendedoresCadastroJsonClient
 * @author omie
 */
class VendedoresCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/vendedores/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/vendedores/';

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
                //echo '<pre>';print_r(json_encode($call));die;
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Inclui um vendedor
	 *
	 * @param vendincluirRequest $vendincluirRequest Solicitação de Inclusão de um vendedor
	 * @return vendIncluirResponse Resposta da Solicitação de inclusão de um vendedor.
	 */
	public function IncluirVendedor($vendincluirRequest){
		return self::_Call('IncluirVendedor',Array(
			$vendincluirRequest
		));
	}

	/**
	 * Altera os dados de um vendedor
	 *
	 * @param vendAlterarRequest $vendAlterarRequest Solicitação de Alteração de um vendedor
	 * @return vendAlterarResponse Resposta da Solicitação de alteração de um vendedor.
	 */
	public function AlterarVendedor($vendAlterarRequest){
		return self::_Call('AlterarVendedor',Array(
			$vendAlterarRequest
		));
	}

	/**
	 * Inclui / Altera um vendedor
	 *
	 * @param vendUpsertRequest $vendUpsertRequest Solicitação de Inclusão/Alteração de um vendedor
	 * @return vendUpsertResponse Resposta da Solicitação de inclusão/alteração de um vendedor.
	 */
	public function UpsertVendedor($vendUpsertRequest){
		return self::_Call('UpsertVendedor',Array(
			$vendUpsertRequest
		));
	}

	/**
	 * Exclui um vendedor
	 *
	 * @param vendExcluirRequest $vendExcluirRequest Solicitação de Exclusão de um fornecedor.
	 * @return vendExcluirResponse Resposta da Solicitação de exclusão de um vendedor.
	 */
	public function ExcluirVendedor($vendExcluirRequest){
		return self::_Call('ExcluirVendedor',Array(
			$vendExcluirRequest
		));
	}

	/**
	 * Consulta os dados de um vendedor
	 *
	 * @param vendConsultarRequest $vendConsultarRequest Solicitação de Consulta de um Vendedor
	 * @return vendConsultarResponse Reposta da consulta de Vendedores
	 */
	public function ConsultarVendedor($vendConsultarRequest){
		return self::_Call('ConsultarVendedor',Array(
			$vendConsultarRequest
		));
	}

	/**
	 * Listagem de Vendedores
	 *
	 * @param vendListarRequest $vendListarRequest Solicitação de Listagem de Vendedores
	 * @return vendListarResponse Resposta da listagem de Vendedores
	 */
	public function ListarVendedores($vendListarRequest){
		return self::_Call('ListarVendedores',Array(
			$vendListarRequest
		));
	}
}

/**
 * Cadastro de Vendedores
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_complex cadastro
 */
class cadastro{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
        public $comissao;
        public $email;
        public $fatura_pedido;
        public $visualiza_pedido;
}


/**
 * Solicitação de Listagem de Vendedores
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros por página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código
 * @pw_element string $ordem_descrescente Exibir em Ordem Crescente ou Descrescente
 * @pw_element string $filtrar_por_data_de Filtra os registros até a data especificada.
 * @pw_element string $filtrar_por_data_ate Filtra os registros até a data especificada.
 * @pw_element string $filtrar_apenas_inclusao Filtra os registros exibindos apenas os incluídos.
 * @pw_element string $filtrar_apenas_alteracao Filtra os registros exibindos apenas os alterados.
 * @pw_complex vendListarRequest
 */
class vendListarRequest{
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
	 * Ordem de exibição dos dados. Padrão: Código
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Exibir em Ordem Crescente ou Descrescente
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
 * Resposta da listagem de Vendedores
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros por página.
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element cadastroArray $cadastro Cadastro de Vendedores
 * @pw_complex vendListarResponse
 */
class vendListarResponse{
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
	 * Cadastro de Vendedores
	 *
	 * @var cadastroArray
	 */
	public $cadastro;
}

/**
 * Solicitação de Consulta de um Vendedor
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_complex vendConsultarRequest
 */
class vendConsultarRequest{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
}

/**
 * Reposta da consulta de Vendedores
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_complex vendConsultarResponse
 */
class vendConsultarResponse{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
}

/**
 * Solicitação de Alteração de um vendedor
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_complex vendAlterarRequest
 */
class vendAlterarRequest{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
}

/**
 * Solicitação de Inclusão/Alteração de um vendedor
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_complex vendUpsertRequest
 */
class vendUpsertRequest{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
}

/**
 * Solicitação de Inclusão de um vendedor
 *
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_complex vendincluirRequest
 */
class vendincluirRequest{
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
}

/**
 * Solicitação de Exclusão de um fornecedor.
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_complex vendExcluirRequest
 */
class vendExcluirRequest{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
}

/**
 * Resposta da Solicitação de inclusão de um vendedor.
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendIncluirResponse
 */
class vendIncluirResponse{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Resposta da Solicitação de alteração de um vendedor.
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendAlterarResponse
 */
class vendAlterarResponse{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Resposta da Solicitação de inclusão/alteração de um vendedor.
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendUpsertResponse
 */
class vendUpsertResponse{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Resposta da Solicitação de exclusão de um vendedor.
 *
 * @pw_element integer $codigo Código do vendedor
 * @pw_element string $codInt Código de Integração do vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendExcluirResponse
 */
class vendExcluirResponse{
	/**
	 * Código do vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
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
}*/