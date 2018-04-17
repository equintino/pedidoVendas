<?php 
 class ContaSearchCriteria{
   private $id;
               public function getid(){
                return $this->id;
              }
              public function setid($id){
                  $this->id=$id;
                  return $this;
              }
   private $tabela;
               public function gettabela(){
                return $this->tabela;
              }
              public function settabela($tabela){
                  $this->tabela=$tabela;
                  return $this;
              }
   private $excluido;
               public function getexcluido(){
                return $this->excluido;
              }
              public function setexcluido($excluido){
                  $this->excluido=$excluido;
                  return $this;
              }
   private $criado;
               public function getcriado(){
                return $this->criado;
              }
              public function setcriado($criado){
                  $this->criado=$criado;
                  return $this;
              }
   private $bol_instr1;
               public function getbol_instr1(){
                return $this->bol_instr1;
              }
              public function setbol_instr1($bol_instr1){
                  $this->bol_instr1 = $bol_instr1;
                  return $this;
              }
   private $bol_sn;
               public function getbol_sn(){
                return $this->bol_sn;
              }
              public function setbol_sn($bol_sn){
                  $this->bol_sn = $bol_sn;
                  return $this;
              }
   private $cobr_sn;
               public function getcobr_sn(){
                return $this->cobr_sn;
              }
              public function setcobr_sn($cobr_sn){
                  $this->cobr_sn = $cobr_sn;
                  return $this;
              }
   private $codigo_agencia;
               public function getcodigo_agencia(){
                return $this->codigo_agencia;
              }
              public function setcodigo_agencia($codigo_agencia){
                  $this->codigo_agencia = $codigo_agencia;
                  return $this;
              }
   private $codigo_banco;
               public function getcodigo_banco(){
                return $this->codigo_banco;
              }
              public function setcodigo_banco($codigo_banco){
                  $this->codigo_banco = $codigo_banco;
                  return $this;
              }
   private $data_alt;
               public function getdata_alt(){
                return $this->data_alt;
              }
              public function setdata_alt($data_alt){
                  $this->data_alt = $data_alt;
                  return $this;
              }
   private $data_inc;
               public function getdata_inc(){
                return $this->data_inc;
              }
              public function setdata_inc($data_inc){
                  $this->data_inc = $data_inc;
                  return $this;
              }
   private $descricao;
               public function getdescricao(){
                return $this->descricao;
              }
              public function setdescricao($descricao){
                  $this->descricao = $descricao;
                  return $this;
              }
   private $dias_rcomp;
               public function getdias_rcomp(){
                return $this->dias_rcomp;
              }
              public function setdias_rcomp($dias_rcomp){
                  $this->dias_rcomp = $dias_rcomp;
                  return $this;
              }
   private $hora_alt;
               public function gethora_alt(){
                return $this->hora_alt;
              }
              public function sethora_alt($hora_alt){
                  $this->hora_alt = $hora_alt;
                  return $this;
              }
   private $hora_inc;
               public function gethora_inc(){
                return $this->hora_inc;
              }
              public function sethora_inc($hora_inc){
                  $this->hora_inc = $hora_inc;
                  return $this;
              }
   private $nCodCC;
               public function getnCodCC(){
                return $this->nCodCC;
              }
              public function setnCodCC($nCodCC){
                  $this->nCodCC = $nCodCC;
                  return $this;
              }
   private $nao_fluxo;
               public function getnao_fluxo(){
                return $this->nao_fluxo;
              }
              public function setnao_fluxo($nao_fluxo){
                  $this->nao_fluxo = $nao_fluxo;
                  return $this;
              }
   private $nao_resumo;
               public function getnao_resumo(){
                return $this->nao_resumo;
              }
              public function setnao_resumo($nao_resumo){
                  $this->nao_resumo = $nao_resumo;
                  return $this;
              }
   private $numero_conta_corrente;
               public function getnumero_conta_corrente(){
                return $this->numero_conta_corrente;
              }
              public function setnumero_conta_corrente($numero_conta_corrente){
                  $this->numero_conta_corrente = $numero_conta_corrente;
                  return $this;
              }
   private $pdv_cod_adm;
               public function getpdv_cod_adm(){
                return $this->pdv_cod_adm;
              }
              public function setpdv_cod_adm($pdv_cod_adm){
                  $this->pdv_cod_adm = $pdv_cod_adm;
                  return $this;
              }
   private $pdv_dias_venc;
               public function getpdv_dias_venc(){
                return $this->pdv_dias_venc;
              }
              public function setpdv_dias_venc($pdv_dias_venc){
                  $this->pdv_dias_venc = $pdv_dias_venc;
                  return $this;
              }
   private $pdv_enviar;
               public function getpdv_enviar(){
                return $this->pdv_enviar;
              }
              public function setpdv_enviar($pdv_enviar){
                  $this->pdv_enviar = $pdv_enviar;
                  return $this;
              }
   private $pdv_limite_pacelas;
               public function getpdv_limite_pacelas(){
                return $this->pdv_limite_pacelas;
              }
              public function setpdv_limite_pacelas($pdv_limite_pacelas){
                  $this->pdv_limite_pacelas = $pdv_limite_pacelas;
                  return $this;
              }
   private $pdv_num_parcelas;
               public function getpdv_num_parcelas(){
                return $this->pdv_num_parcelas;
              }
              public function setpdv_num_parcelas($pdv_num_parcelas){
                  $this->pdv_num_parcelas = $pdv_num_parcelas;
                  return $this;
              }
   private $pdv_sincr_analitica;
               public function getpdv_sincr_analitica(){
                return $this->pdv_sincr_analitica;
              }
              public function setpdv_sincr_analitica($pdv_sincr_analitica){
                  $this->pdv_sincr_analitica = $pdv_sincr_analitica;
                  return $this;
              }
   private $pdv_taxa_adm;
               public function getpdv_taxa_adm(){
                return $this->pdv_taxa_adm;
              }
              public function setpdv_taxa_adm($pdv_taxa_adm){
                  $this->pdv_taxa_adm = $pdv_taxa_adm;
                  return $this;
              }
   private $pdv_taxa_loja;
               public function getpdv_taxa_loja(){
                return $this->pdv_taxa_loja;
              }
              public function setpdv_taxa_loja($pdv_taxa_loja){
                  $this->pdv_taxa_loja = $pdv_taxa_loja;
                  return $this;
              }
   private $pdv_tipo_tef;
               public function getpdv_tipo_tef(){
                return $this->pdv_tipo_tef;
              }
              public function setpdv_tipo_tef($pdv_tipo_tef){
                  $this->pdv_tipo_tef = $pdv_tipo_tef;
                  return $this;
              }
   private $per_juros;
               public function getper_juros(){
                return $this->per_juros;
              }
              public function setper_juros($per_juros){
                  $this->per_juros = $per_juros;
                  return $this;
              }
   private $per_multa;
               public function getper_multa(){
                return $this->per_multa;
              }
              public function setper_multa($per_multa){
                  $this->per_multa = $per_multa;
                  return $this;
              }
   private $saldo_inicial;
               public function getsaldo_inicial(){
                return $this->saldo_inicial;
              }
              public function setsaldo_inicial($saldo_inicial){
                  $this->saldo_inicial = $saldo_inicial;
                  return $this;
              }
   private $tipo;
               public function gettipo(){
                return $this->tipo;
              }
              public function settipo($tipo){
                  $this->tipo = $tipo;
                  return $this;
              }
   private $tipo_conta_corrente;
               public function gettipo_conta_corrente(){
                return $this->tipo_conta_corrente;
              }
              public function settipo_conta_corrente($tipo_conta_corrente){
                  $this->tipo_conta_corrente = $tipo_conta_corrente;
                  return $this;
              }
   private $user_alt;
               public function getuser_alt(){
                return $this->user_alt;
              }
              public function setuser_alt($user_alt){
                  $this->user_alt = $user_alt;
                  return $this;
              }
   private $user_inc;
               public function getuser_inc(){
                return $this->user_inc;
              }
              public function setuser_inc($user_inc){
                  $this->user_inc = $user_inc;
                  return $this;
              }
   private $valor_limite;
               public function getvalor_limite(){
                return $this->valor_limite;
              }
              public function setvalor_limite($valor_limite){
                  $this->valor_limite = $valor_limite;
                  return $this;
              }
   private $OMIE_APP_KEY;
               public function getOMIE_APP_KEY(){
                return $this->OMIE_APP_KEY;
              }
              public function setOMIE_APP_KEY($OMIE_APP_KEY){
                  $this->OMIE_APP_KEY = $OMIE_APP_KEY;
                  return $this;
              }
}