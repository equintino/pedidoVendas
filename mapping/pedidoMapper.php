<?php class pedidoMapper{ public static function map(pedido $pedido, array $properties){if (array_key_exists('id', $properties)){  $pedido->setid($properties['id']);}if (array_key_exists('tabela', $properties)){  $pedido->settabela($properties['tabela']);}if (array_key_exists('excluido', $properties)){  $pedido->setexcluido($properties['excluido']);}if (array_key_exists('criado', $properties)){  $pedido->setcriado($properties['criado']);}if (array_key_exists('cCliente', $properties)){  $pedido->setcCliente($properties['cCliente']);}if (array_key_exists('cliente', $properties)){  $pedido->setcliente($properties['cliente']);}if (array_key_exists('dPrevisao', $properties)){  $pedido->setdPrevisao($properties['dPrevisao']);}if (array_key_exists('endereco', $properties)){  $pedido->setendereco($properties['endereco']);}if (array_key_exists('endereco_numero', $properties)){  $pedido->setendereco_numero($properties['endereco_numero']);}if (array_key_exists('bairro', $properties)){  $pedido->setbairro($properties['bairro']);}if (array_key_exists('cidade', $properties)){  $pedido->setcidade($properties['cidade']);}if (array_key_exists('cep', $properties)){  $pedido->setcep($properties['cep']);}if (array_key_exists('cnpj_cpf', $properties)){  $pedido->setcnpj_cpf($properties['cnpj_cpf']);}if (array_key_exists('tItem', $properties)){  $pedido->settItem($properties['tItem']);}if (array_key_exists('mercadorias', $properties)){  $pedido->setmercadorias($properties['mercadorias']);}if (array_key_exists('vDesconto', $properties)){  $pedido->setvDesconto($properties['vDesconto']);}if (array_key_exists('vPedido', $properties)){  $pedido->setvPedido($properties['vPedido']);}if (array_key_exists('vendedor', $properties)){  $pedido->setvendedor($properties['vendedor']);}if (array_key_exists('cod_vend', $properties)){  $pedido->setcod_vend($properties['cod_vend']);}if (array_key_exists('parcela', $properties)){  $pedido->setparcela($properties['parcela']);}if (array_key_exists('fPagamento', $properties)){  $pedido->setfPagamento($properties['fPagamento']);}if (array_key_exists('doc', $properties)){  $pedido->setdoc($properties['doc']);}if (array_key_exists('transportadora', $properties)){  $pedido->settransportadora($properties['transportadora']);}if (array_key_exists('codigo_transportadora', $properties)){  $pedido->setcodigo_transportadora($properties['codigo_transportadora']);}if (array_key_exists('tfrete', $properties)){  $pedido->settfrete($properties['tfrete']);}if (array_key_exists('qvolume', $properties)){  $pedido->setqvolume($properties['qvolume']);}if (array_key_exists('codigo_categoria', $properties)){  $pedido->setcodigo_categoria($properties['codigo_categoria']);}if (array_key_exists('codigo_conta_corrente', $properties)){  $pedido->setcodigo_conta_corrente($properties['codigo_conta_corrente']);}if (array_key_exists('etapa', $properties)){  $pedido->setetapa($properties['etapa']);}if (array_key_exists('dados_adcionais_nf', $properties)){  $pedido->setdados_adcionais_nf($properties['dados_adcionais_nf']);}if (array_key_exists('email', $properties)){  $pedido->setemail($properties['email']);}if (array_key_exists('codigo_produto', $properties)){  $pedido->setcodigo_produto($properties['codigo_produto']);}if (array_key_exists('descricao', $properties)){  $pedido->setdescricao($properties['descricao']);}if (array_key_exists('quantidade', $properties)){  $pedido->setquantidade($properties['quantidade']);}if (array_key_exists('vUnitarioItem', $properties)){  $pedido->setvUnitarioItem($properties['vUnitarioItem']);}if (array_key_exists('pDescontoItem', $properties)){  $pedido->setpDescontoItem($properties['pDescontoItem']);}if (array_key_exists('obs_item', $properties)){  $pedido->setobs_item($properties['obs_item']);}if (array_key_exists('cfop', $properties)){  $pedido->setcfop($properties['cfop']);}if (array_key_exists('ncm', $properties)){  $pedido->setncm($properties['ncm']);}if (array_key_exists('ean', $properties)){  $pedido->setean($properties['ean']);}if (array_key_exists('unidade', $properties)){  $pedido->setunidade($properties['unidade']);}if (array_key_exists('vTotalItem', $properties)){  $pedido->setvTotalItem($properties['vTotalItem']);}if (array_key_exists('pTabela', $properties)){  $pedido->setpTabela($properties['pTabela']);}if (array_key_exists('cOmie', $properties)){  $pedido->setcOmie($properties['cOmie']);}if (array_key_exists('numero_parcela', $properties)){  $pedido->setnumero_parcela($properties['numero_parcela']);}if (array_key_exists('data_vencimento', $properties)){  $pedido->setdata_vencimento($properties['data_vencimento']);}if (array_key_exists('valor', $properties)){  $pedido->setvalor($properties['valor']);}if (array_key_exists('percentual', $properties)){  $pedido->setpercentual($properties['percentual']);}if (array_key_exists('pedido', $properties)){  $pedido->setpedido($properties['pedido']);}if (array_key_exists('codigo_pedido_integracao', $properties)){  $pedido->setcodigo_pedido_integracao($properties['codigo_pedido_integracao']);}if (array_key_exists('modificado', $properties)){  $pedido->setmodificado($properties['modificado']);}  } }