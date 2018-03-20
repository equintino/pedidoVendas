<?php
/**
 * @service EmpresasCadastroJsonClient
 * @author omie
 */
class EmpresasCadastroJsonClient {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/geral/empresas/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/geral/empresas/';

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
	 * Realiza a consulta de um registro especifico
	 *
	 * @param empresas_consultar $empresas_consultar Consulta um código no cadastro de Empresas
	 * @return empresas_cadastro Cadastro de Empresas
	 */
	public function ConsultarEmpresa($empresas_consultar){
		return self::_Call('ConsultarEmpresa',Array(
			$empresas_consultar
		));
	}

	/**
	 * Lista as empresas cadastradas no Omie.
	 *
	 * @param empresas_list_request $empresas_list_request Lista as empresas cadastradas
	 * @return empresas_list_response Lista de empresas cadastradas no omie.
	 */
	public function ListarEmpresas($empresas_list_request){
		return self::_Call('ListarEmpresas',Array(
			$empresas_list_request
		));
	}
}

/**
 * Cadastro de Empresas
 *
 * @pw_element integer $codigo_empresa Código da Empresa
 * @pw_element string $codigo_empresa_integracao Código de Integração
 * @pw_element string $cnpj CNPJ da Empresa
 * @pw_element string $razao_social Razão Social
 * @pw_element string $nome_fantasia Nome Fantasia
 * @pw_element string $logradouro Logradouro
 * @pw_element string $endereco Endereço da Empresa
 * @pw_element string $endereco_numero Número do Endereço
 * @pw_element string $complemento Complemento do Número do Endereço
 * @pw_element string $bairro Bairro
 * @pw_element string $cidade Código da Cidade
 * @pw_element string $estado Estado da Empresa
 * @pw_element string $cep CEP
 * @pw_element string $codigo_pais Código do País
 * @pw_element string $data_adesao_sn Data de Adesão ao Simples Nacional
 * @pw_element string $telefone1_ddd DDD
 * @pw_element string $telefone1_numero Telefones da Empresa
 * @pw_element string $telefone2_ddd DDD Telefone 2
 * @pw_element string $telefone2_numero Telefone 2
 * @pw_element string $fax_ddd DDD Fax
 * @pw_element string $fax_numero Fax da Empresa
 * @pw_element string $email E-mail da Empresa
 * @pw_element string $website WebSite
 * @pw_element string $cnae Código do CNAE - Fiscal
 * @pw_element string $cnae_municipal Código do CNAE - Municipal
 * @pw_element string $inscricao_estadual Inscrição Estadual
 * @pw_element string $inscricao_municipal Inscrição Municipal
 * @pw_element string $inscricao_suframa Inscrição no SUFRAMA
 * @pw_element string $regime_tributario Regime Tributário
 * @pw_element string $inativa Indica que a empresa está ativa
 * @pw_element string $gera_nfse Gera Nota Fiscal de Serviço Eletrônica para o Município [S/N]
 * @pw_element string $optante_simples_nacional Indica que a empresa é optante pelo Simples Nacional
 * @pw_element string $sped_codigo_incidencia_tributaria SPED PIS/COFINS - Código Indicador da Incidência Tributária no Período
 * @pw_element string $sped_codigo_tipo_contribuicao SPED PIS/COFINS - Código indicador do Tipo de Contribuição Apurada no Período
 * @pw_element string $sped_cpf_contador SPED - CPF do Contador Responsável  pela Empresa
 * @pw_element string $sped_crc_contador SPED - CRC do Contador Responsável  pela Empresa
 * @pw_element string $sped_usa_contabilidade_terceirizada SPED - Indica se a Empresa utiliza Contabilidade Terceirizada
 * @pw_element string $sped_email_contador SPED - Email do Contador da Empresa
 * @pw_element string $sped_codigo_indicador_apropriacao_credito SPED PIS/COFINS - Código Código Indicador de Método de Apropriação de Créditos Comuns
 * @pw_element string $sped_codigo_tipo_atividade SPED PIS/COFINS - Código Indicador de Tipo de Atividade Preponderante
 * @pw_element string $sped_natureza_pessoa_juridica SPED PIS/COFINS - Indicador da Natureza da Pessoa Jurídica
 * @pw_element string $sped_codigo_criterio_escrituracao SPED PIS/COFINS - Código Indicador do Critério de Escrituração e Apuração
 * @pw_element string $sped_junta_comercial SPED - Indica se o Local do Registro é Junta  Comercial
 * @pw_element string $sped_matriz SPED - Indica se a empresa é Matriz
 * @pw_element string $sped_nome_contador SPED - Nome do Contador Responsável  pela Empresa
 * @pw_element string $sped_registro_junta_comercial SPED - Número do Registro da Empresa na Junta Comercial ou no Cartório
 * @pw_element string $efd_atividade_industrial EFD - Indica se a atividade é industrial ou equiparado a indústria
 * @pw_element string $efd_perfil_arquivo_fiscal Perfil de Apresentação do Arquivo Fiscal - EFD
 * @pw_element string $ecd_codigo_cadastral SPED / ECD - Código cadastral na Instituição Responsável
 * @pw_element string $ecd_codigo_instituicao_responsavel SPED / ECD - Código da Instituição Responsável pela Administração do Cadastro
 * @pw_element string $gera_nfe Gera Nota Fiscal Eletrônica Âmbito Nacional (DANFE) [S/N]
 * @pw_element string $inclusao_data Data de inclusão
 * @pw_element string $inclusao_hora Hora de inclusão.
 * @pw_element string $alteracao_data Data de alteração
 * @pw_element string $alteracao_hora Hora de alteração
 * @pw_element string $bloqueado Registro bloqueado pela API
 * @pw_element string $pdv_sincr_analitica Sincronizar Estoque de Forma Análitica (Venda a Venda)
 * @pw_element string $importado_api Importado da API.
 * @pw_element string $dt_adesao_simpnac Data de Adesão do Simples Nacional
 * @pw_element string $ie_st Inscrição Estadual para ST
 * @pw_element string $recibo_ide Identificação do Profissional (contador, advogado, etc) para o Recibo de Prestação de Serviço
 * @pw_element string $gera_recibo Gera Recibo de Prestação de Serviço [S/N]
 * @pw_element string $recibo_tipo Tipo (modelo) do Recibo de Prestação de Serviço
 * @pw_element string $recibo_num_vias Indica de o Recibo de Prestação de Serviço será gerado em 2 vias
 * @pw_complex empresas_cadastro
 */
class empresas_cadastro{
	/**
	 * Código da Empresa
	 *
	 * @var integer
	 */
	public $codigo_empresa;
	/**
	 * Código de Integração
	 *
	 * @var string
	 */
	public $codigo_empresa_integracao;
	/**
	 * CNPJ da Empresa
	 *
	 * @var string
	 */
	public $cnpj;
	/**
	 * Razão Social
	 *
	 * @var string
	 */
	public $razao_social;
	/**
	 * Nome Fantasia
	 *
	 * @var string
	 */
	public $nome_fantasia;
	/**
	 * Logradouro
	 *
	 * @var string
	 */
	public $logradouro;
	/**
	 * Endereço da Empresa
	 *
	 * @var string
	 */
	public $endereco;
	/**
	 * Número do Endereço
	 *
	 * @var string
	 */
	public $endereco_numero;
	/**
	 * Complemento do Número do Endereço
	 *
	 * @var string
	 */
	public $complemento;
	/**
	 * Bairro
	 *
	 * @var string
	 */
	public $bairro;
	/**
	 * Código da Cidade
	 *
	 * @var string
	 */
	public $cidade;
	/**
	 * Estado da Empresa
	 *
	 * @var string
	 */
	public $estado;
	/**
	 * CEP
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
	 * Data de Adesão ao Simples Nacional
	 *
	 * @var string
	 */
	public $data_adesao_sn;
	/**
	 * DDD
	 *
	 * @var string
	 */
	public $telefone1_ddd;
	/**
	 * Telefones da Empresa
	 *
	 * @var string
	 */
	public $telefone1_numero;
	/**
	 * DDD Telefone 2
	 *
	 * @var string
	 */
	public $telefone2_ddd;
	/**
	 * Telefone 2
	 *
	 * @var string
	 */
	public $telefone2_numero;
	/**
	 * DDD Fax
	 *
	 * @var string
	 */
	public $fax_ddd;
	/**
	 * Fax da Empresa
	 *
	 * @var string
	 */
	public $fax_numero;
	/**
	 * E-mail da Empresa
	 *
	 * @var string
	 */
	public $email;
	/**
	 * WebSite
	 *
	 * @var string
	 */
	public $website;
	/**
	 * Código do CNAE - Fiscal
	 *
	 * @var string
	 */
	public $cnae;
	/**
	 * Código do CNAE - Municipal
	 *
	 * @var string
	 */
	public $cnae_municipal;
	/**
	 * Inscrição Estadual
	 *
	 * @var string
	 */
	public $inscricao_estadual;
	/**
	 * Inscrição Municipal
	 *
	 * @var string
	 */
	public $inscricao_municipal;
	/**
	 * Inscrição no SUFRAMA
	 *
	 * @var string
	 */
	public $inscricao_suframa;
	/**
	 * Regime Tributário
	 *
	 * @var string
	 */
	public $regime_tributario;
	/**
	 * Indica que a empresa está ativa
	 *
	 * @var string
	 */
	public $inativa;
	/**
	 * Gera Nota Fiscal de Serviço Eletrônica para o Município [S/N]
	 *
	 * @var string
	 */
	public $gera_nfse;
	/**
	 * Indica que a empresa é optante pelo Simples Nacional
	 *
	 * @var string
	 */
	public $optante_simples_nacional;
	/**
	 * SPED PIS/COFINS - Código Indicador da Incidência Tributária no Período
	 *
	 * @var string
	 */
	public $sped_codigo_incidencia_tributaria;
	/**
	 * SPED PIS/COFINS - Código indicador do Tipo de Contribuição Apurada no Período
	 *
	 * @var string
	 */
	public $sped_codigo_tipo_contribuicao;
	/**
	 * SPED - CPF do Contador Responsável  pela Empresa
	 *
	 * @var string
	 */
	public $sped_cpf_contador;
	/**
	 * SPED - CRC do Contador Responsável  pela Empresa
	 *
	 * @var string
	 */
	public $sped_crc_contador;
	/**
	 * SPED - Indica se a Empresa utiliza Contabilidade Terceirizada
	 *
	 * @var string
	 */
	public $sped_usa_contabilidade_terceirizada;
	/**
	 * SPED - Email do Contador da Empresa
	 *
	 * @var string
	 */
	public $sped_email_contador;
	/**
	 * SPED PIS/COFINS - Código Código Indicador de Método de Apropriação de Créditos Comuns
	 *
	 * @var string
	 */
	public $sped_codigo_indicador_apropriacao_credito;
	/**
	 * SPED PIS/COFINS - Código Indicador de Tipo de Atividade Preponderante
	 *
	 * @var string
	 */
	public $sped_codigo_tipo_atividade;
	/**
	 * SPED PIS/COFINS - Indicador da Natureza da Pessoa Jurídica
	 *
	 * @var string
	 */
	public $sped_natureza_pessoa_juridica;
	/**
	 * SPED PIS/COFINS - Código Indicador do Critério de Escrituração e Apuração
	 *
	 * @var string
	 */
	public $sped_codigo_criterio_escrituracao;
	/**
	 * SPED - Indica se o Local do Registro é Junta  Comercial
	 *
	 * @var string
	 */
	public $sped_junta_comercial;
	/**
	 * SPED - Indica se a empresa é Matriz
	 *
	 * @var string
	 */
	public $sped_matriz;
	/**
	 * SPED - Nome do Contador Responsável  pela Empresa
	 *
	 * @var string
	 */
	public $sped_nome_contador;
	/**
	 * SPED - Número do Registro da Empresa na Junta Comercial ou no Cartório
	 *
	 * @var string
	 */
	public $sped_registro_junta_comercial;
	/**
	 * EFD - Indica se a atividade é industrial ou equiparado a indústria
	 *
	 * @var string
	 */
	public $efd_atividade_industrial;
	/**
	 * Perfil de Apresentação do Arquivo Fiscal - EFD
	 *
	 * @var string
	 */
	public $efd_perfil_arquivo_fiscal;
	/**
	 * SPED / ECD - Código cadastral na Instituição Responsável
	 *
	 * @var string
	 */
	public $ecd_codigo_cadastral;
	/**
	 * SPED / ECD - Código da Instituição Responsável pela Administração do Cadastro
	 *
	 * @var string
	 */
	public $ecd_codigo_instituicao_responsavel;
	/**
	 * Gera Nota Fiscal Eletrônica Âmbito Nacional (DANFE) [S/N]
	 *
	 * @var string
	 */
	public $gera_nfe;
	/**
	 * Data de inclusão
	 *
	 * @var string
	 */
	public $inclusao_data;
	/**
	 * Hora de inclusão.
	 *
	 * @var string
	 */
	public $inclusao_hora;
	/**
	 * Data de alteração
	 *
	 * @var string
	 */
	public $alteracao_data;
	/**
	 * Hora de alteração
	 *
	 * @var string
	 */
	public $alteracao_hora;
	/**
	 * Registro bloqueado pela API
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * Sincronizar Estoque de Forma Análitica (Venda a Venda)
	 *
	 * @var string
	 */
	public $pdv_sincr_analitica;
	/**
	 * Importado da API.
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * Data de Adesão do Simples Nacional
	 *
	 * @var string
	 */
	public $dt_adesao_simpnac;
	/**
	 * Inscrição Estadual para ST
	 *
	 * @var string
	 */
	public $ie_st;
	/**
	 * Identificação do Profissional (contador, advogado, etc) para o Recibo de Prestação de Serviço
	 *
	 * @var string
	 */
	public $recibo_ide;
	/**
	 * Gera Recibo de Prestação de Serviço [S/N]
	 *
	 * @var string
	 */
	public $gera_recibo;
	/**
	 * Tipo (modelo) do Recibo de Prestação de Serviço
	 *
	 * @var string
	 */
	public $recibo_tipo;
	/**
	 * Indica de o Recibo de Prestação de Serviço será gerado em 2 vias
	 *
	 * @var string
	 */
	public $recibo_num_vias;
}


/**
 * Consulta um código no cadastro de Empresas
 *
 * @pw_element integer $codigo_empresa Código da Empresa
 * @pw_complex empresas_consultar
 */
class empresas_consultar{
	/**
	 * Código da Empresa
	 *
	 * @var integer
	 */
	public $codigo_empresa;
}

/**
 * Lista as empresas cadastradas
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api DEPRECATED
 * @pw_element string $ordenar_por DEPRECATED
 * @pw_element string $ordem_descrescente DEPRECATED
 * @pw_element string $filtrar_por_data_de DEPRECATED
 * @pw_element string $filtrar_por_data_ate DEPRECATED
 * @pw_element string $filtrar_apenas_inclusao DEPRECATED
 * @pw_element string $filtrar_apenas_alteracao DEPRECATED
 * @pw_complex empresas_list_request
 */
class empresas_list_request{
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
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $ordem_descrescente;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * DEPRECATED
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
}

/**
 * Lista de empresas cadastradas no omie.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element empresas_cadastroArray $empresas_cadastro Cadastro de Empresas
 * @pw_complex empresas_list_response
 */
class empresas_list_response{
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
	 * Cadastro de Empresas
	 *
	 * @var empresas_cadastroArray
	 */
	public $empresas_cadastro;
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