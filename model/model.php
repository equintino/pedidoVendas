<?php 
 class Model{
	 private $id; 
	 public function getid(){
		 return $this->id; 
 	}
	 public function setid($id){
		$this->id=$id;
 	}
	 private $tabela; 
	 public function gettabela(){
		 return $this->tabela; 
 	}
	 public function settabela($tabela){
		$this->tabela=$tabela;
 	}
	 private $excluido; 
	 public function getexcluido(){
		 return $this->excluido; 
 	}
	 public function setexcluido($excluido){
		$this->excluido=$excluido;
 	}
	 private $criado; 
	 public function getcriado(){
		 return $this->criado; 
 	}
	 public function setcriado($criado){
		$this->criado=$criado;
 	}
 private $bairro;
 public function getbairro(){
	return $this->bairro;
 }
 public function setbairro($bairro ){
	$this->bairro=$bairro;
 }
 private $cep;
 public function getcep(){
	return $this->cep;
 }
 public function setcep($cep ){
	$this->cep=$cep;
 }
 private $cidade;
 public function getcidade(){
	return $this->cidade;
 }
 public function setcidade($cidade ){
	$this->cidade=$cidade;
 }
 private $cidade_ibge;
 public function getcidade_ibge(){
	return $this->cidade_ibge;
 }
 public function setcidade_ibge($cidade_ibge ){
	$this->cidade_ibge=$cidade_ibge;
 }
 private $cnae;
 public function getcnae(){
	return $this->cnae;
 }
 public function setcnae($cnae ){
	$this->cnae=$cnae;
 }
 private $cnpj_cpf;
 public function getcnpj_cpf(){
	return $this->cnpj_cpf;
 }
 public function setcnpj_cpf($cnpj_cpf ){
	$this->cnpj_cpf=$cnpj_cpf;
 }
 private $codigo_cliente_integracao;
 public function getcodigo_cliente_integracao(){
	return $this->codigo_cliente_integracao;
 }
 public function setcodigo_cliente_integracao($codigo_cliente_integracao ){
	$this->codigo_cliente_integracao=$codigo_cliente_integracao;
 }
 private $codigo_cliente_omie;
 public function getcodigo_cliente_omie(){
	return $this->codigo_cliente_omie;
 }
 public function setcodigo_cliente_omie($codigo_cliente_omie ){
	$this->codigo_cliente_omie=$codigo_cliente_omie;
 }
 private $codigo_pais;
 public function getcodigo_pais(){
	return $this->codigo_pais;
 }
 public function setcodigo_pais($codigo_pais ){
	$this->codigo_pais=$codigo_pais;
 }
 private $complemento;
 public function getcomplemento(){
	return $this->complemento;
 }
 public function setcomplemento($complemento ){
	$this->complemento=$complemento;
 }
 private $email;
 public function getemail(){
	return $this->email;
 }
 public function setemail($email ){
	$this->email=$email;
 }
 private $endereco;
 public function getendereco(){
	return $this->endereco;
 }
 public function setendereco($endereco ){
	$this->endereco=$endereco;
 }
 private $endereco_numero;
 public function getendereco_numero(){
	return $this->endereco_numero;
 }
 public function setendereco_numero($endereco_numero ){
	$this->endereco_numero=$endereco_numero;
 }
 private $estado;
 public function getestado(){
	return $this->estado;
 }
 public function setestado($estado ){
	$this->estado=$estado;
 }
 private $exterior;
 public function getexterior(){
	return $this->exterior;
 }
 public function setexterior($exterior ){
	$this->exterior=$exterior;
 }
 private $cImpAPI;
 public function getcImpAPI(){
	return $this->cImpAPI;
 }
 public function setcImpAPI($cImpAPI ){
	$this->cImpAPI=$cImpAPI;
 }
 private $dAlt;
 public function getdAlt(){
	return $this->dAlt;
 }
 public function setdAlt($dAlt ){
	$this->dAlt=$dAlt;
 }
 private $dInc;
 public function getdInc(){
	return $this->dInc;
 }
 public function setdInc($dInc ){
	$this->dInc=$dInc;
 }
 private $hAlt;
 public function gethAlt(){
	return $this->hAlt;
 }
 public function sethAlt($hAlt ){
	$this->hAlt=$hAlt;
 }
 private $hInc;
 public function gethInc(){
	return $this->hInc;
 }
 public function sethInc($hInc ){
	$this->hInc=$hInc;
 }
 private $uAlt;
 public function getuAlt(){
	return $this->uAlt;
 }
 public function setuAlt($uAlt ){
	$this->uAlt=$uAlt;
 }
 private $uInc;
 public function getuInc(){
	return $this->uInc;
 }
 public function setuInc($uInc ){
	$this->uInc=$uInc;
 }
 private $info;
 public function getinfo(){
	return $this->info;
 }
 public function setinfo($info ){
	$this->info=$info;
 }
 private $inscricao_estadual;
 public function getinscricao_estadual(){
	return $this->inscricao_estadual;
 }
 public function setinscricao_estadual($inscricao_estadual ){
	$this->inscricao_estadual=$inscricao_estadual;
 }
 private $inscricao_municipal;
 public function getinscricao_municipal(){
	return $this->inscricao_municipal;
 }
 public function setinscricao_municipal($inscricao_municipal ){
	$this->inscricao_municipal=$inscricao_municipal;
 }
 private $nome_fantasia;
 public function getnome_fantasia(){
	return $this->nome_fantasia;
 }
 public function setnome_fantasia($nome_fantasia ){
	$this->nome_fantasia=$nome_fantasia;
 }
 private $pessoa_fisica;
 public function getpessoa_fisica(){
	return $this->pessoa_fisica;
 }
 public function setpessoa_fisica($pessoa_fisica ){
	$this->pessoa_fisica=$pessoa_fisica;
 }
 private $razao_social;
 public function getrazao_social(){
	return $this->razao_social;
 }
 public function setrazao_social($razao_social ){
	$this->razao_social=$razao_social;
 }
 private $tags;
 public function gettags(){
	return $this->tags;
 }
 public function settags($tags ){
	$this->tags=$tags;
 }
 private $telefone1_ddd;
 public function gettelefone1_ddd(){
	return $this->telefone1_ddd;
 }
 public function settelefone1_ddd($telefone1_ddd ){
	$this->telefone1_ddd=$telefone1_ddd;
 }
 private $telefone1_numero;
 public function gettelefone1_numero(){
	return $this->telefone1_numero;
 }
 public function settelefone1_numero($telefone1_numero ){
	$this->telefone1_numero=$telefone1_numero;
 }
 private $tipo_atividade;
 public function gettipo_atividade(){
	return $this->tipo_atividade;
 }
 public function settipo_atividade($tipo_atividade ){
	$this->tipo_atividade=$tipo_atividade;
 }
 private $cod_API;
 public function getcod_API(){
	return $this->cod_API;
 }
 public function setcod_API($cod_API ){
	$this->cod_API=$cod_API;
 }
 private $contato;
 public function getcontato(){
	return $this->contato;
 }
 public function setcontato($contato ){
	$this->contato=$contato;
 }
 private $optante_simples_nacional;
 public function getoptante_simples_nacional(){
	return $this->optante_simples_nacional;
 }
 public function setoptante_simples_nacional($optante_simples_nacional ){
	$this->optante_simples_nacional=$optante_simples_nacional;
 }
 private $telefone2_ddd;
 public function gettelefone2_ddd(){
	return $this->telefone2_ddd;
 }
 public function settelefone2_ddd($telefone2_ddd ){
	$this->telefone2_ddd=$telefone2_ddd;
 }
 private $telefone2_numero;
 public function gettelefone2_numero(){
	return $this->telefone2_numero;
 }
 public function settelefone2_numero($telefone2_numero ){
	$this->telefone2_numero=$telefone2_numero;
 }
 private $fax_ddd;
 public function getfax_ddd(){
	return $this->fax_ddd;
 }
 public function setfax_ddd($fax_ddd ){
	$this->fax_ddd=$fax_ddd;
 }
 private $fax_numero;
 public function getfax_numero(){
	return $this->fax_numero;
 }
 public function setfax_numero($fax_numero ){
	$this->fax_numero=$fax_numero;
 }
 private $homepage;
 public function gethomepage(){
	return $this->homepage;
 }
 public function sethomepage($homepage ){
	$this->homepage=$homepage;
 }
 private $observacao;
 public function getobservacao(){
	return $this->observacao;
 }
 public function setobservacao($observacao ){
	$this->observacao=$observacao;
 }
 private $contribuinte;
 public function getcontribuinte(){
	return $this->contribuinte;
 }
 public function setcontribuinte($contribuinte ){
	$this->contribuinte=$contribuinte;
 }
 }