<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Medula+One" rel="stylesheet">
        
        <script>
            $(document).ready(function(){
                
                if((!flash && numero_pedido) || direto==1){
                    $('.erro').hide();
                    window.print();
                    //window.close();
                    /*window.location='../web/index.php?pagina=pedido&act=cad';*/
                }
            })
        </script>
        <style>
            *{
                padding: 0;
                margin: 0;
            }
            body{
                background: #000;
                font: 11pt serif;
                font-weight: 900;
                width: 105mm;
                text-transform: uppercase;
                line-height: 1.4;
            }
            .hr {
                border-top: 1px dashed black;
                border-bottom: 1px dashed black;
                border-left: none;
                height: 4px;
            }
            hr {
                border-top: 1px dashed black;
                border-bottom: none;
                margin: 2px;
            }
            .fim{
                border-top: 1px solid black;
                border-bottom: none;                
            }
            #texto{
                width: 100%; 
                margin: auto;
            }
            .conteudo{
                width: 86mm;
                background: white;
                padding: 20px;
            }
            h3{
                text-align: center;
            }
            .endereco, .web{
                text-align: center;
            }
            .cnpj{
                margin-top: 10px;
            }
            h2{
                text-align: center;
                margin-top: 8px;
            }
            .pedido{
                float: right;
            }
            .titulo1{
                margin-top: 10px;
            }
            .titulo2{
                margin-top: 5px;
            }
            .descricao{
                margin-left: 25px;
            }
            .qtd, .quant{
                margin-left: 20px;
            }
            .vlUnit{
                margin-left: 30px;
            }
            .vlItem, .vTotalItem2{
                float: right;
            }
            .cod{
                margin-left: 30px;
            }
            .desc{
                margin-left: 30px;
            }
            .quant{
                margin-right: 20px;
            }
            .vlUnit2{
                margin-left: 40px;
            }
            .vTotal{
                float: right;
            }
            .desconto{
                float: right;
            }
            .hrTotal{
                width: 40%;
                float: right;
            }
            .final{
                clear: both;
                margin-top: 20px;
            }
            .rodape{
                text-align: center;
            }
            .erro{
                color: red;
            }
            .fpagamento{
                clear: right;
                float: right;
                margin-top: 15px;
            }
            
            @media print{
                .conteudo {
                    /*-webkit-column-count: 1; /* Chrome, Safari, Opera */
                    /*-moz-column-count: 1; /* Firefox */
                    /*column-count: 1;*/
                }
            }
            @page{
                size: auto;
                margin: 0mm;
            }
            
            .erro{
                font-weight: 900;
                color: red;
                animation: blinker 1s linear infinite;
                text-align: center;
            }
            .data_{
                float: right;
            }
            .ass{
                margin-top: 15px;
                float: right;
            }
            
            .blink_me {
            }
            @keyframes blinker {
              50% {
                opacity: 0.3;
              }
            }
        </style>
<?php
    function reduz($str,$num){
        if(strlen($str)>$num){
            $str=substr($str,0,$num).'...';
        }
        return $str;
    }
    function abrevia($str){
        $str_=explode(' ',strtoupper($str));
        switch($str_[0]){
            case 'RUA':
                $str_[0]='R.';
                break;
            case 'AVENIDA':
                $str_[0]='AV.';
                break;
            case 'ESTRADA':
                $str_[0]='EST.';
                break;
            case 'TRAVESSA':
                $str_[0]='TRA.';
                break;
            case 'BECO':
                $str_[0]='BC.';
                break;
            case 'PARQUE':
                $str_[0]='PQ.';
                break;
            case 'BLOCO':
                $str_[0]='BLC.';
                break;
        }
        $str=implode($str_);
        return $str;
    }
    
    array_key_exists('direto',$_GET)? $direto=$_GET['direto']: $direto=null;
    if(!isset($flash)){
        array_key_exists('flash',$_GET)? $flash=$_GET['flash']: $flash=null;
    }
    if(!isset($numero_pedido)){
        array_key_exists('numero_pedido',$_GET)? $numero_pedido=$_GET['numero_pedido']: $numero_pedido=null;
    }
    echo '<script>var direto="'.$direto.'";var flash="'.$flash.'";var numero_pedido="'.$numero_pedido.'";</script>';
    if(!$direto){
        @$vendedor=$_POST['vendedor'];
        @$empresaAtualiza=$_GET['empresaAtualiza'];
        @$tItens=$pedido_venda_produto->cabecalho->quantidade_itens;
        @$vPedido=$_POST['vPedido'];
        @$vDesconto=$_POST['vDesconto'];
        $cliente=reduz($_POST['cliente'],20);
        $enderecoCliente=reduz($_POST['endereco'],23);
        $bairroCliente=reduz($_POST['bairro'],12);
        $cepCliente=substr($_POST['cep'],0,4).'-'.substr($_POST['cep'],5,3);
        $cidadeCliente=reduz($_POST['cidade'],25);
        $cnpj_cpfCliente=$_POST['cnpj_cpf'];
    }
    include '../model/EmpresasCadastroJsonClient.php';
    include '../model/empresa.php';
    date_default_timezone_set("Brazil/East");
    
    if($direto){
        include '../dao/UserDao.php';
        include '../dao/UserSearchCriteria.php';
        include '../config/Config.php';
        include '../model/User.php';
        include '../mapping/UserMapper.php';
        include '../dao/PedidoSearchCriteria.php';
        include '../model/pedido.php';
        include '../mapping/pedidoMapper.php';
        include '../excecao/Excecao.php';
        include '../dao/dao.php';
        include '../dao/CRUDPedido.php';

        $user = new UserDao();
        $search = new UserSearchCriteria();
        $search->setLogin($_COOKIE['login']);
        foreach($user->find($search) as $usuario){
            define('OMIE_APP_KEY',$usuario->getOMIE_APP_KEY());
            define('OMIE_APP_SECRET',$usuario->getOMIE_APP_SECRET());
        }
        $search=new PedidoSearchCriteria();
        $search->settabela('tb_pedido');
        $search->setid($_GET['id']);
        $dao=new CRUDPedido();
        foreach($dao->encontrePorPedido($search) as $item){
            $vendedor=$item->getvendedor();
            $tItens=$item->gettItem();
            $vPedido=number_format($item->getvPedido(),'2',',','.');
            $vDesconto=number_format($item->getvDesconto(),'2',',','.');
            $cliente=reduz($item->getcliente(),20);
            $enderecoCliente=reduz($item->getendereco(),23);
            $bairroCliente=reduz($item->getbairro(),12);
            $cepCliente=substr($item->getcep(),0,4).'-'.substr($item->getcep(),5,3);
            $cidadeCliente=reduz($item->getcidade(),25);
            $cnpj_cpfCliente=$item->getcnpj_cpf();
            $numero_pedido=$item->getpedido();
            $codigo_=explode('*/*',$item->getcodigo_produto());
            $descricao_=explode('*/*',$item->getdescricao());
            $quantidade_=explode('*/*',$item->getquantidade());
            $dados_adcionais_item_=explode('*/*',$item->getobs_item());
            $vUnitarioItem_=explode('*/*',$item->getvUnitarioItem());
            $vTotalItem_=explode('*/*',$item->getvTotalItem());
            $fPagamento=$item->getfPagamento();
            $dataHora=date('d/m/Y H:i',$item->getcriado());
        }
    }
    
        
    $empresaAtualiza=1;
    if($empresaAtualiza==1){
        $emp=new EmpresasCadastroJsonClient();
        $empresas_list_request=array("pagina"=>1,"registros_por_pagina"=>100,"apenas_importado_api"=>"N");
        $empresa=$emp->ListarEmpresas($empresas_list_request)->empresas_cadastro;

        foreach($empresa as $item){
            $bairro=$item->bairro;
            $cep=$item->cep;
            $cidade=$item->cidade;
            $cnpj=$item->cnpj;
            $codigo_empresa=$item->codigo_empresa;
            $complemento=$item->complemento;
            $email=$item->email;
            $endereco=$item->endereco;
            $endereco_numero=$item->endereco_numero;
            $estado=$item->estado;
            $inscricao_estadual=$item->inscricao_estadual;
            $nome_fantasia=$item->nome_fantasia;
            $razao_social=$item->razao_social;
            $telefone1_ddd=$item->telefone1_ddd;
            $telefone1_numero=$item->telefone1_numero;
            $website=$item->website;
        }
    }else{
        $empresa=new empresa();
        $bairro=$empresa->bairro;
        $cep=$empresa->cep;
        $cidade=$empresa->cidade;
        $cnpj=$empresa->cnpj;
        $codigo_empresa=$empresa->codigo_empresa;
        $complemento=$empresa->complemento;
        $email=$empresa->email;
        $endereco=$empresa->endereco;
        $endereco_numero=$empresa->endereco_numero;
        $estado=$empresa->estado;
        $inscricao_estadual=$empresa->inscricao_estadual;
        $nome_fantasia=$empresa->nome_fantasia;
        $razao_social=$empresa->razao_social;
        $telefone1_ddd=$empresa->telefone1_ddd;
        $telefone1_numero=$empresa->telefone1_numero;
        $website=$empresa->website;
    }
    
    date_default_timezone_set('America/Sao_Paulo');
?>
    </head>
    <body>
        <div class="conteudo">
            <?php 
                /*@$flash=Flash::getFlashes()[0];*/
                if(@$flash): ?>
            <script>var flash="<?= $flash ?>";</script>
            <div class="erro"><?= $flash ?></div>
            <?php else: ?>
            <script>var flash=null;</script>
            <?php endif ?>
            <hr>
            <div><?= $razao_social ?></div>
            <div><?= $website ?></div>
            <div>Tel. (<?= $telefone1_ddd ?>) <?= substr($telefone1_numero,0,4).'-'.substr($telefone1_numero,4,4) ?> </div>
            <hr class="hr">
            <span>Pedido: <?= preg_replace('/^0+/','',@$numero_pedido) ?></span><br>
            <span>Vendedor: <?= @$vendedor ?></span>
            <?php
                if(!isset($direto)){
                    $dataHora=date('d/m/Y H:i');
                }
            ?>
            <span class="data_"><?= $dataHora ?></span>
            <hr>
            <span class="campos">Cliente: </span><span class="dCliente"><?= $cliente ?></span><br>
            <span class="campos">Endereço: </span><span class="dCliente"><?= abrevia($enderecoCliente) ?></span><br>
            <span class="campos">Bairro: </span><span class="dCliente"><?= abrevia($bairroCliente) ?></span>&nbsp<span class="campos"> - &nbsp Cep: </span><span class="dCliente"><?= $cepCliente ?></span><br>
            <span class="campos">Cidade: </span><span class="dCliente"><?= $cidadeCliente ?></span><br>
            <span class="campos">CPF/CNPJ: </span><span class="dCliente"><?= $cnpj_cpfCliente ?></span><br>
            <hr>
                <span>CÓDIGO-DESCRIÇÃO<br></span>
                <span>QUANTIDADE</span><span class=vlUnit>UNITÁRIO</span><span class='vlItem'>TOTAL</span>
            <hr class="hr">
            <div class="titulo2">
            <?php 
                if(!$direto):
                    $quantidade_=array();
                    for($i=1;$i<=$tItens;$i++): 
                        $codigo=$pedido_venda_produto->det[$i-1]['produto']->codigo_produto_integracao;
                        $descricao=reduz($pedido_venda_produto->det[$i-1]['produto']->descricao,70);
                        $quantidade_[]=$pedido_venda_produto->det[$i-1]['produto']->quantidade;
                        $dados_adcionais_item=$pedido_venda_produto->det[$i-1]['inf_adic']->dados_adicionais_item;
                        $vUnitario=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_unitario,'2',',','.');
                        $vTotalItem=number_format($pedido_venda_produto->det[$i-1]['produto']->valor_mercadoria,'2',',','.');
            ?>
                <?='<span>'.$codigo.' - </span><span>'.$descricao ?><br>
                <span class="quant">&nbsp&nbsp<?= $quantidade_[$i-1].'</span> &nbsp&nbsp&nbsp&nbsp&nbsp X <span class=vlUnit2>'.$vUnitario.'</span><span class=vTotalItem2>'.$vTotalItem ?></span><br>
                <div class="seriais"><?= nl2br($dados_adcionais_item) ?></div>
            <?php endfor;else:
                for($i=0;$i<$tItens;$i++):
                    $codigo=$codigo_[$i];
                    $descricao=reduz($descricao_[$i],70);
                    $quantidade=$quantidade_[$i];
                    $dados_adcionais_item=$dados_adcionais_item_[$i];
                    $vUnitarioItem=number_format($vUnitarioItem_[$i],'2',',','.');
                    $vTotalItem=number_format($vTotalItem_[$i],'2',',','.');
            ?>
                <?='<span>'.$codigo.' - </span><span>'.$descricao ?><br>
                <span class="quant">&nbsp&nbsp<?= $quantidade.'</span> &nbsp&nbsp&nbsp&nbsp&nbsp X <span class=vlUnit2>'.$vUnitarioItem.'</span><span class=vTotalItem2>'.$vTotalItem ?></span><br>
                <div class="seriais"><?= nl2br($dados_adcionais_item) ?></div>
                <?php endfor;endif; ?>
            </div>
            <hr>
            <span>Total Desconto: <?= $vDesconto ?></span><br>
            <span class="total">TOTAL Geral: </span>
            <span><?= $vPedido ?></span><br>
            <span>Total Qtd -> <?= array_sum($quantidade_) ?></span>
            <hr>
            <span>(FORM. PAG.) &nbsp<?= $fPagamento ?></span>
            <hr>
            RECEBI OS PRODUTOS CONSTANTE NESTE PEDIDO E RECONHEÇO A DIVIDA ACIMA,
            <span class='ass'>______________________________</span>
            <br><br><br><br>
            <hr class='fim'>
            <div class="rodape">DEUS SEJA LOUVADO!</div>
        </div>
        <!--<button onclick='window.print()'>Imprimir</button>-->
    </body>
</html>