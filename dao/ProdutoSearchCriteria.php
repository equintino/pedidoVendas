<?php 
 class ProdutoSearchCriteria{
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
   private $loja;
               public function getloja(){
                return $this->loja;
              }
              public function setloja($loja){
                  $this->loja = $loja;
                  return $this;
              }
   private $videos;
               public function getvideos(){
                return $this->videos;
              }
              public function setvideos($videos){
                  $this->videos = $videos;
                  return $this;
              }
   private $aliquota_cofins;
               public function getaliquota_cofins(){
                return $this->aliquota_cofins;
              }
              public function setaliquota_cofins($aliquota_cofins){
                  $this->aliquota_cofins = $aliquota_cofins;
                  return $this;
              }
   private $aliquota_ibpt;
               public function getaliquota_ibpt(){
                return $this->aliquota_ibpt;
              }
              public function setaliquota_ibpt($aliquota_ibpt){
                  $this->aliquota_ibpt = $aliquota_ibpt;
                  return $this;
              }
   private $aliquota_icms;
               public function getaliquota_icms(){
                return $this->aliquota_icms;
              }
              public function setaliquota_icms($aliquota_icms){
                  $this->aliquota_icms = $aliquota_icms;
                  return $this;
              }
   private $aliquota_pis;
               public function getaliquota_pis(){
                return $this->aliquota_pis;
              }
              public function setaliquota_pis($aliquota_pis){
                  $this->aliquota_pis = $aliquota_pis;
                  return $this;
              }
   private $altura;
               public function getaltura(){
                return $this->altura;
              }
              public function setaltura($altura){
                  $this->altura = $altura;
                  return $this;
              }
   private $bloqueado;
               public function getbloqueado(){
                return $this->bloqueado;
              }
              public function setbloqueado($bloqueado){
                  $this->bloqueado = $bloqueado;
                  return $this;
              }
   private $cest;
               public function getcest(){
                return $this->cest;
              }
              public function setcest($cest){
                  $this->cest = $cest;
                  return $this;
              }
   private $cfop;
               public function getcfop(){
                return $this->cfop;
              }
              public function setcfop($cfop){
                  $this->cfop = $cfop;
                  return $this;
              }
   private $codInt_familia;
               public function getcodInt_familia(){
                return $this->codInt_familia;
              }
              public function setcodInt_familia($codInt_familia){
                  $this->codInt_familia = $codInt_familia;
                  return $this;
              }
   private $codigo;
               public function getcodigo(){
                return $this->codigo;
              }
              public function setcodigo($codigo){
                  $this->codigo = $codigo;
                  return $this;
              }
   private $codigo_familia;
               public function getcodigo_familia(){
                return $this->codigo_familia;
              }
              public function setcodigo_familia($codigo_familia){
                  $this->codigo_familia = $codigo_familia;
                  return $this;
              }
   private $codigo_produto;
               public function getcodigo_produto(){
                return $this->codigo_produto;
              }
              public function setcodigo_produto($codigo_produto){
                  $this->codigo_produto = $codigo_produto;
                  return $this;
              }
   private $codigo_produto_integracao;
               public function getcodigo_produto_integracao(){
                return $this->codigo_produto_integracao;
              }
              public function setcodigo_produto_integracao($codigo_produto_integracao){
                  $this->codigo_produto_integracao = $codigo_produto_integracao;
                  return $this;
              }
   private $csosn_icms;
               public function getcsosn_icms(){
                return $this->csosn_icms;
              }
              public function setcsosn_icms($csosn_icms){
                  $this->csosn_icms = $csosn_icms;
                  return $this;
              }
   private $cst_cofins;
               public function getcst_cofins(){
                return $this->cst_cofins;
              }
              public function setcst_cofins($cst_cofins){
                  $this->cst_cofins = $cst_cofins;
                  return $this;
              }
   private $cst_icms;
               public function getcst_icms(){
                return $this->cst_icms;
              }
              public function setcst_icms($cst_icms){
                  $this->cst_icms = $cst_icms;
                  return $this;
              }
   private $cst_pis;
               public function getcst_pis(){
                return $this->cst_pis;
              }
              public function setcst_pis($cst_pis){
                  $this->cst_pis = $cst_pis;
                  return $this;
              }
   private $dadosIbpt;
               public function getdadosIbpt(){
                return $this->dadosIbpt;
              }
              public function setdadosIbpt($dadosIbpt){
                  $this->dadosIbpt = $dadosIbpt;
                  return $this;
              }
   private $aliqEstadual;
               public function getaliqEstadual(){
                return $this->aliqEstadual;
              }
              public function setaliqEstadual($aliqEstadual){
                  $this->aliqEstadual = $aliqEstadual;
                  return $this;
              }
   private $aliqFederal;
               public function getaliqFederal(){
                return $this->aliqFederal;
              }
              public function setaliqFederal($aliqFederal){
                  $this->aliqFederal = $aliqFederal;
                  return $this;
              }
   private $aliqMunicipal;
               public function getaliqMunicipal(){
                return $this->aliqMunicipal;
              }
              public function setaliqMunicipal($aliqMunicipal){
                  $this->aliqMunicipal = $aliqMunicipal;
                  return $this;
              }
   private $chave;
               public function getchave(){
                return $this->chave;
              }
              public function setchave($chave){
                  $this->chave = $chave;
                  return $this;
              }
   private $fonte;
               public function getfonte(){
                return $this->fonte;
              }
              public function setfonte($fonte){
                  $this->fonte = $fonte;
                  return $this;
              }
   private $valido_ate;
               public function getvalido_ate(){
                return $this->valido_ate;
              }
              public function setvalido_ate($valido_ate){
                  $this->valido_ate = $valido_ate;
                  return $this;
              }
   private $valido_de;
               public function getvalido_de(){
                return $this->valido_de;
              }
              public function setvalido_de($valido_de){
                  $this->valido_de = $valido_de;
                  return $this;
              }
   private $versao;
               public function getversao(){
                return $this->versao;
              }
              public function setversao($versao){
                  $this->versao = $versao;
                  return $this;
              }
   private $descr_detalhada;
               public function getdescr_detalhada(){
                return $this->descr_detalhada;
              }
              public function setdescr_detalhada($descr_detalhada){
                  $this->descr_detalhada = $descr_detalhada;
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
   private $descricao_familia;
               public function getdescricao_familia(){
                return $this->descricao_familia;
              }
              public function setdescricao_familia($descricao_familia){
                  $this->descricao_familia = $descricao_familia;
                  return $this;
              }
   private $dias_crossdocking;
               public function getdias_crossdocking(){
                return $this->dias_crossdocking;
              }
              public function setdias_crossdocking($dias_crossdocking){
                  $this->dias_crossdocking = $dias_crossdocking;
                  return $this;
              }
   private $dias_garantia;
               public function getdias_garantia(){
                return $this->dias_garantia;
              }
              public function setdias_garantia($dias_garantia){
                  $this->dias_garantia = $dias_garantia;
                  return $this;
              }
   private $ean;
               public function getean(){
                return $this->ean;
              }
              public function setean($ean){
                  $this->ean = $ean;
                  return $this;
              }
   private $estoque_minimo;
               public function getestoque_minimo(){
                return $this->estoque_minimo;
              }
              public function setestoque_minimo($estoque_minimo){
                  $this->estoque_minimo = $estoque_minimo;
                  return $this;
              }
   private $imagens;
               public function getimagens(){
                return $this->imagens;
              }
              public function setimagens($imagens){
                  $this->imagens = $imagens;
                  return $this;
              }
   private $url_imagem;
               public function geturl_imagem(){
                return $this->url_imagem;
              }
              public function seturl_imagem($url_imagem){
                  $this->url_imagem = $url_imagem;
                  return $this;
              }
   private $importado_api;
               public function getimportado_api(){
                return $this->importado_api;
              }
              public function setimportado_api($importado_api){
                  $this->importado_api = $importado_api;
                  return $this;
              }
   private $inativo;
               public function getinativo(){
                return $this->inativo;
              }
              public function setinativo($inativo){
                  $this->inativo = $inativo;
                  return $this;
              }
   private $largura;
               public function getlargura(){
                return $this->largura;
              }
              public function setlargura($largura){
                  $this->largura = $largura;
                  return $this;
              }
   private $marca;
               public function getmarca(){
                return $this->marca;
              }
              public function setmarca($marca){
                  $this->marca = $marca;
                  return $this;
              }
   private $ncm;
               public function getncm(){
                return $this->ncm;
              }
              public function setncm($ncm){
                  $this->ncm = $ncm;
                  return $this;
              }
   private $obs_internas;
               public function getobs_internas(){
                return $this->obs_internas;
              }
              public function setobs_internas($obs_internas){
                  $this->obs_internas = $obs_internas;
                  return $this;
              }
   private $peso_bruto;
               public function getpeso_bruto(){
                return $this->peso_bruto;
              }
              public function setpeso_bruto($peso_bruto){
                  $this->peso_bruto = $peso_bruto;
                  return $this;
              }
   private $peso_liq;
               public function getpeso_liq(){
                return $this->peso_liq;
              }
              public function setpeso_liq($peso_liq){
                  $this->peso_liq = $peso_liq;
                  return $this;
              }
   private $profundidade;
               public function getprofundidade(){
                return $this->profundidade;
              }
              public function setprofundidade($profundidade){
                  $this->profundidade = $profundidade;
                  return $this;
              }
   private $quantidade_estoque;
               public function getquantidade_estoque(){
                return $this->quantidade_estoque;
              }
              public function setquantidade_estoque($quantidade_estoque){
                  $this->quantidade_estoque = $quantidade_estoque;
                  return $this;
              }
   private $recomendacoes_fiscais;
               public function getrecomendacoes_fiscais(){
                return $this->recomendacoes_fiscais;
              }
              public function setrecomendacoes_fiscais($recomendacoes_fiscais){
                  $this->recomendacoes_fiscais = $recomendacoes_fiscais;
                  return $this;
              }
   private $cupom_fiscal;
               public function getcupom_fiscal(){
                return $this->cupom_fiscal;
              }
              public function setcupom_fiscal($cupom_fiscal){
                  $this->cupom_fiscal = $cupom_fiscal;
                  return $this;
              }
   private $id_cest;
               public function getid_cest(){
                return $this->id_cest;
              }
              public function setid_cest($id_cest){
                  $this->id_cest = $id_cest;
                  return $this;
              }
   private $id_preco_tabelado;
               public function getid_preco_tabelado(){
                return $this->id_preco_tabelado;
              }
              public function setid_preco_tabelado($id_preco_tabelado){
                  $this->id_preco_tabelado = $id_preco_tabelado;
                  return $this;
              }
   private $market_place;
               public function getmarket_place(){
                return $this->market_place;
              }
              public function setmarket_place($market_place){
                  $this->market_place = $market_place;
                  return $this;
              }
   private $origem_mercadoria;
               public function getorigem_mercadoria(){
                return $this->origem_mercadoria;
              }
              public function setorigem_mercadoria($origem_mercadoria){
                  $this->origem_mercadoria = $origem_mercadoria;
                  return $this;
              }
   private $red_base_icms;
               public function getred_base_icms(){
                return $this->red_base_icms;
              }
              public function setred_base_icms($red_base_icms){
                  $this->red_base_icms = $red_base_icms;
                  return $this;
              }
   private $tipoItem;
               public function gettipoItem(){
                return $this->tipoItem;
              }
              public function settipoItem($tipoItem){
                  $this->tipoItem = $tipoItem;
                  return $this;
              }
   private $unidade;
               public function getunidade(){
                return $this->unidade;
              }
              public function setunidade($unidade){
                  $this->unidade = $unidade;
                  return $this;
              }
   private $valor_unitario;
               public function getvalor_unitario(){
                return $this->valor_unitario;
              }
              public function setvalor_unitario($valor_unitario){
                  $this->valor_unitario = $valor_unitario;
                  return $this;
              }
}