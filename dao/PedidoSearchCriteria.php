<?php class PedidoSearchCriteria{ private $id;public function getid(){return $this->id;}public function setid($id){$this->id=$id;return $this;} private $tabela;public function gettabela(){return $this->tabela;}public function settabela($tabela){$this->tabela=$tabela;return $this;} private $excluido;public function getexcluido(){return $this->excluido;}public function setexcluido($excluido){$this->excluido=$excluido;return $this;} private $criado;public function getcriado(){return $this->criado;}public function setcriado($criado){$this->criado=$criado;return $this;} private $cCliente;public function getcCliente(){return $this->cCliente;}public function setcCliente($cCliente){$this->cCliente = $cCliente;return $this;} private $cliente;public function getcliente(){return $this->cliente;}public function setcliente($cliente){$this->cliente = $cliente;return $this;} private $dPrevisao;public function getdPrevisao(){return $this->dPrevisao;}public function setdPrevisao($dPrevisao){$this->dPrevisao = $dPrevisao;return $this;} private $endereco;public function getendereco(){return $this->endereco;}public function setendereco($endereco){$this->endereco = $endereco;return $this;} private $endereco_numero;public function getendereco_numero(){return $this->endereco_numero;}public function setendereco_numero($endereco_numero){$this->endereco_numero = $endereco_numero;return $this;} private $bairro;public function getbairro(){return $this->bairro;}public function setbairro($bairro){$this->bairro = $bairro;return $this;} private $cidade;public function getcidade(){return $this->cidade;}public function setcidade($cidade){$this->cidade = $cidade;return $this;} private $cep;public function getcep(){return $this->cep;}public function setcep($cep){$this->cep = $cep;return $this;} private $cnpj_cpf;public function getcnpj_cpf(){return $this->cnpj_cpf;}public function setcnpj_cpf($cnpj_cpf){$this->cnpj_cpf = $cnpj_cpf;return $this;} private $tItem;public function gettItem(){return $this->tItem;}public function settItem($tItem){$this->tItem = $tItem;return $this;} private $mercadorias;public function getmercadorias(){return $this->mercadorias;}public function setmercadorias($mercadorias){$this->mercadorias = $mercadorias;return $this;} private $vDesconto;public function getvDesconto(){return $this->vDesconto;}public function setvDesconto($vDesconto){$this->vDesconto = $vDesconto;return $this;} private $vPedido;public function getvPedido(){return $this->vPedido;}public function setvPedido($vPedido){$this->vPedido = $vPedido;return $this;} private $vendedor;public function getvendedor(){return $this->vendedor;}public function setvendedor($vendedor){$this->vendedor = $vendedor;return $this;} private $cod_vend;public function getcod_vend(){return $this->cod_vend;}public function setcod_vend($cod_vend){$this->cod_vend = $cod_vend;return $this;} private $parcela;public function getparcela(){return $this->parcela;}public function setparcela($parcela){$this->parcela = $parcela;return $this;} private $fPagamento;public function getfPagamento(){return $this->fPagamento;}public function setfPagamento($fPagamento){$this->fPagamento = $fPagamento;return $this;} private $doc;public function getdoc(){return $this->doc;}public function setdoc($doc){$this->doc = $doc;return $this;} private $transportadora;public function gettransportadora(){return $this->transportadora;}public function settransportadora($transportadora){$this->transportadora = $transportadora;return $this;} private $codigo_transportadora;public function getcodigo_transportadora(){return $this->codigo_transportadora;}public function setcodigo_transportadora($codigo_transportadora){$this->codigo_transportadora = $codigo_transportadora;return $this;} private $tfrete;public function gettfrete(){return $this->tfrete;}public function settfrete($tfrete){$this->tfrete = $tfrete;return $this;} private $qvolume;public function getqvolume(){return $this->qvolume;}public function setqvolume($qvolume){$this->qvolume = $qvolume;return $this;} private $codigo_categoria;public function getcodigo_categoria(){return $this->codigo_categoria;}public function setcodigo_categoria($codigo_categoria){$this->codigo_categoria = $codigo_categoria;return $this;} private $codigo_conta_corrente;public function getcodigo_conta_corrente(){return $this->codigo_conta_corrente;}public function setcodigo_conta_corrente($codigo_conta_corrente){$this->codigo_conta_corrente = $codigo_conta_corrente;return $this;} private $etapa;public function getetapa(){return $this->etapa;}public function setetapa($etapa){$this->etapa = $etapa;return $this;} private $dados_adcionais_nf;public function getdados_adcionais_nf(){return $this->dados_adcionais_nf;}public function setdados_adcionais_nf($dados_adcionais_nf){$this->dados_adcionais_nf = $dados_adcionais_nf;return $this;} private $email;public function getemail(){return $this->email;}public function setemail($email){$this->email = $email;return $this;} private $codigo_produto;public function getcodigo_produto(){return $this->codigo_produto; }public function setcodigo_produto($codigo_produto){$this->codigo_produto = $codigo_produto;return $this;} private $descricao;public function getdescricao(){return $this->descricao; }public function setdescricao($descricao){$this->descricao = $descricao;return $this;} private $quantidade;public function getquantidade(){return $this->quantidade; }public function setquantidade($quantidade){$this->quantidade = $quantidade;return $this;} private $vUnitarioItem;public function getvUnitarioItem(){return $this->vUnitarioItem; }public function setvUnitarioItem($vUnitarioItem){$this->vUnitarioItem = $vUnitarioItem;return $this;} private $pDescontoItem;public function getpDescontoItem(){return $this->pDescontoItem; }public function setpDescontoItem($pDescontoItem){$this->pDescontoItem = $pDescontoItem;return $this;} private $obs_item;public function getobs_item(){return $this->obs_item; }public function setobs_item($obs_item){$this->obs_item = $obs_item;return $this;} private $cfop;public function getcfop(){return $this->cfop; }public function setcfop($cfop){$this->cfop = $cfop;return $this;} private $ncm;public function getncm(){return $this->ncm; }public function setncm($ncm){$this->ncm = $ncm;return $this;} private $ean;public function getean(){return $this->ean; }public function setean($ean){$this->ean = $ean;return $this;} private $unidade;public function getunidade(){return $this->unidade; }public function setunidade($unidade){$this->unidade = $unidade;return $this;} private $vTotalItem;public function getvTotalItem(){return $this->vTotalItem; }public function setvTotalItem($vTotalItem){$this->vTotalItem = $vTotalItem;return $this;} private $pTabela;public function getpTabela(){return $this->pTabela; }public function setpTabela($pTabela){$this->pTabela = $pTabela;return $this;} private $cOmie;public function getcOmie(){return $this->cOmie; }public function setcOmie($cOmie){$this->cOmie = $cOmie;return $this;} private $numero_parcela;public function getnumero_parcela(){return $this->numero_parcela; }public function setnumero_parcela($numero_parcela){$this->numero_parcela = $numero_parcela;return $this;} private $data_vencimento;public function getdata_vencimento(){return $this->data_vencimento; }public function setdata_vencimento($data_vencimento){$this->data_vencimento = $data_vencimento;return $this;} private $valor;public function getvalor(){return $this->valor; }public function setvalor($valor){$this->valor = $valor;return $this;} private $percentual;public function getpercentual(){return $this->percentual; }public function setpercentual($percentual){$this->percentual = $percentual;return $this;} private $pedido;public function getpedido(){return $this->pedido;}public function setpedido($pedido){$this->pedido = $pedido;return $this;} private $codigo_pedido_integracao;public function getcodigo_pedido_integracao(){return $this->codigo_pedido_integracao;}public function setcodigo_pedido_integracao($codigo_pedido_integracao){$this->codigo_pedido_integracao = $codigo_pedido_integracao;return $this;} private $modificado;public function getmodificado(){return $this->modificado;}public function setmodificado($modificado){$this->modificado = $modificado;return $this;} private $dSemana;public function getdSemana(){return $this->dSemana;}public function setdSemana($dSemana){$this->dSemana = $dSemana;return $this;}}