<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatórios</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../web/css/jquery.dataTables.min.css"/>
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css' />
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.structure.min.css' />
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.theme.min.css' />
        <script type="text/javascript" src='../web/js/jquery-3.2.1.min.js' ></script>
        <script type="text/javascript" src='../web/js/jquery.dataTables.min.js' ></script>
        <script type='text/javascript' src='js/jquery-ui.min.js'></script>
        <script type='text/javascript'>
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = new Date(formataData($('#min').val()));
                    var max = new Date(formataData($('#max').val()));
                    /*var age = parseFloat( data[0] ) || 0;*/
                    var dat = new Date(formataData(data[2])) || 0;
                    if ( ( isNaN( min ) && isNaN( max ) ) ||
                         ( isNaN( min ) && dat <= max ) ||
                         ( min <= dat   && isNaN( max ) ) ||
                         ( min <= dat   && dat <= max ) )
                    {
                        return true;
                    }
                    return false;
                }
            );
            function formataData(str){
                var dia=str.substr(0,2);
                var mes=str.substr(3,2);
                var ano=str.substr(-4,4);
                return mes+'/'+dia+'/'+ano;
            }
            $(document).ready(function(){
                $('#min').datepicker({dateFormat: 'dd/mm/yy'});
                $('#max').datepicker({dateFormat: 'dd/mm/yy'});
                var table=$('#tabela1').DataTable({
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                            {
                                "targets": [ 1 ],
                                "visible": true,
                                "searchable": true
                            }
                        ],
                    "stateSave": true,
                    "scroolX": true,
                    /*"language": {
                            "decimal": ",",
                            "thousands": "."
                        },*/
                    "language": {
                            "lengthMenu": "Exibir _MENU_ registros por página",
                            "zeroRecords": "Nenhum registro encontrado",
                            "info": "Exibindo pág _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum registro disponível",
                            "infoFiltered": "(total de _MAX_ registros)"
                        },
                    "pagingType": "full_numbers",
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
                        total = api
                            .column( 4 )
                            .data()
                            .reduce( function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0 );
                        pageTotal = api
                            .column( 4, { page: 'current' } )
                            .data()
                            .reduce( function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0 );
                        $( api.column( 1 ).footer() ).html(
                            'R$ '+numeroParaMoeda(pageTotal)+' (Total R$ '+numeroParaMoeda(total)+')'
                        );
                    }
                });
                $('#max, #min').change( function() {
                    table.draw();
                    $( '#linhas' ).text( 'Linhas exibidas: '+ table.column({page:'current'} ).data().length );
                } );
                $('select#campoCol').change(function () {
                    var column = table.column($(':selected').attr('id'));
                    column.visible( ! column.visible() );
                    $(this).val('');
                } );
                $('.bntNf').mouseover(function(){
                    $(this).css('cursor','pointer');
                    $(this).click(function(){
                        var perg = confirm('A tabela STATUS será recriada. Deseja continuar?');
                        if(perg){
                            $(location).attr('href','statusPedido.php?act=atualiza');
                        }else{
                            return false;
                        }
                    });
                });
                $(document).on('keyup click', function(){
                    $( '#linhas' ).text( 'Linhas exibidas: '+ table.column({page:'current'} ).data().length );
                    nfCancelada();
                });
                $( '#linhas' ).text( 'Linhas exibidas: '+ table.column({page:'current'} ).data().length );
                $('#principal').show();
                nfCancelada();
                function nfCancelada(){
                    $('tbody tr').each(function(){
                        if($(this).attr('style')=='color: red'){
                            $(this).css('color','#ccc');
                            $(this).click(function(){
                                alert('Possivelmente esta nota foi cancelada.');
                                return false;
                            });
                        } 
                    });
                }
            });
            function numeroParaMoeda(n, c, d, t){
                c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");    
            } 
        </script>
        <?php
            /*funcoes*/
            function geraCampos($campos){
                $campo[$campos->numero_pedido]=array();
                $dPedido[$campos->numero_pedido]=array();
                foreach($campos as $key => $item){
                    if($key != 'ListaNfe'){
                        array_push($campo[$campos->numero_pedido],$key);
                        array_push($dPedido[$campos->numero_pedido],$item);
                    }else{
                        foreach($item as $item2){
                            foreach($item2 as $key3 => $item3){
                                if($key3 != 'mensagens'){
                                    array_push($campo[$campos->numero_pedido],$key3);
                                    array_push($dPedido[$campos->numero_pedido],$item3);
                                }
                            }
                        }
                    }
                }
                $arr=([$campo,$dPedido]);
                return $arr;
            }
            function defineEtapa($etapa){
                switch($etapa){
                    case 10:
                        $etapa='Pedido de Venda';
                        break;
                    case 20:
                        $etapa='Separar Estoque';
                        break;
                    case 40:
                        $etapa='Faturar';
                        break;
                    case 50:
                        $etapa='Faturado';
                        break;
                    case 60: case 70:
                        $etapa='Entrega';
                        break;
                }
                return $etapa;
            }
            function confereTabela($tabela){
                $daoPedido=new dao();
                if(OMIE_APP_KEY=='2769656370'){
                    $db='db';
                }elseif(OMIE_APP_KEY=='461893204773'){
                    $db='db2';
                }else{
                    $db='db3';
                }
                $tab=$daoPedido->showTabela($tabela,$db);
                return $tab;
            }
            
            
            array_key_exists('act', $_GET)? $act=$_GET['act']: $act=null;
            array_key_exists('seleciona',$_GET)? $seleciona=$_GET['seleciona']: $seleciona=null;
        
            include "menu.php";
            include 'relatorio.php';
            include '../model/PedidoVendaProdutoJsonClient.php';
            $pedidoVendaOmie=new PedidoVendaProdutoJsonClient();
            $pedidoVendaLocal=new pedido();
            $searchPedido=new PedidoSearchCriteria();
            $daoPedido=new CRUDPedido();
            $searchPedido->settabela('tb_pedido');
            if(!confereTabela('tb_status')){
                $act='atualiza';
            }
            
            if(file_exists('../dao/CRUDStatus.php')){
                include '../dao/CRUDStatus.php';
                include '../model/modelStatus.php';
                include '../dao/StatusSearchCriteria.php';
                include '../mapping/statusMapper.php';
            }else{
                $act='atualiza';
            }
            if($act=='atualiza'){
                $tabelaAtualizando='Status Pedidos';
                if(!isset($seleciona)){
                    $seleciona=0;
                    echo '<script>pagina="statusPedido";codTabela="nenhum";act="atualiza";</script>';
                    include '../paginas/atualizando.php';
                    exit;
                }else{
                    echo '<script>var seleciona=2</script>';
                    include '../paginas/atualizando.php';
                }
                $daoPedido->drop('tb_status');
                $pedidoLocal=$daoPedido->encontrePorPedido($searchPedido,'ASC');
                $registros=count($pedidoLocal);
                $pedidoInexistente=array();
                $y=1;
                if(!file_exists('../dao/CRUDStatus.php')){
                    foreach($pedidoLocal as $item){
                        $codigo_pedido=$item->getcodigo_pedido();
                        $pvpStatusRequest=array("codigo_pedido"=>$codigo_pedido,"codigo_pedido_integracao"=>"");
                        $statusPedido=$pedidoVendaOmie->StatusPedido($pvpStatusRequest);
                        if($statusPedido->ListaNfe){
                            include '../paginas/criaClasses6.php';
                            $arqClasse=new criaClasses6();
                            foreach(geraCampos($statusPedido)[0] as $item){
                                $variaveis=$item;
                            }
                            $arqClasse->novoArquivo($variaveis);
                            sleep(2);
                            $classeCriada=1;
                            goto segue;
                        }
                    }
                }
                segue:
                foreach($pedidoLocal as $item){
                    $codigo_pedido=$item->getcodigo_pedido();
                    $pvpStatusRequest=array("codigo_pedido"=>$codigo_pedido,"codigo_pedido_integracao"=>"");
                    $statusPedido=$pedidoVendaOmie->StatusPedido($pvpStatusRequest);
                    if(!$statusPedido){
                        array_push($pedidoInexistente,$codigo_pedido);
                        goto s;
                    }
                    if(isset($classeCriada)){
                        include '../dao/CRUDStatus.php';
                        include '../model/modelStatus.php';
                        include '../dao/StatusSearchCriteria.php';
                    }
                    $status=new status();
                    foreach($statusPedido as $key => $item){
                        if($key != 'ListaNfe'){
                            $classe='set'.$key;
                            $status->$classe($item);
                        }else{
                            if($item){
                                foreach($item[0] as $key2 => $item2){
                                    if($key2 != 'mensagens'){
                                        $classe='set'.$key2;
                                        $status->$classe($item2);
                                    }
                                }
                            }
                        }
                    }
                    $daoStatus=new CRUDStatus();
                    $status->settabela('tb_status');
                    $gravado=$daoStatus->grava8($status);
                    s:
                    echo '<script>document.getElementById("cont").innerHTML="Percentual concluido '.number_format($y*100/$registros,'0','.','').'%";</script>';
                    $y++;
                }
                echo '<script>window.location.assign("statusPedido.php");</script>';
            }else{
                $daoStatus=new CRUDStatus();
                $search=new StatusSearchCriteria();
                $search->settabela('tb_status');
                $dados=$daoStatus->encontrePorStatus($search);
            }
        ?>
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Nunito:600');
        #principal {
            margin: auto;
            width: 1120px;
            display: none;
            //margin-top: -100px; 
        }

        #tabela1 {
           font-family: Verdana, Geneva, Tahoma, sans-serif;
           font-size: 13px;
        }

        thead tr{
            //background-image: rgb(38, 93, 141);
            background: url(../web/img/fundoAzulmarinho.png) repeat-x right bottom;
            background-size: 4.5px;
            color: white;
            white-space: nowrap;
        }
        .ocultarCol{
            position: absolute;
            margin-top: 10px;
            font-size: 18px;
        }
        .titulo{
            text-align: center;
            margin: 40px auto;
            text-shadow: 1px 1px 2px #888;
            font-family: 'Nunito', sans-serif;
            font-size: 30px;
            width: 300px;
        }
        #linhas{
            position: absolute;
            margin-top: 55px;
        }
        .bntNf{
            float: right;
            margin-top: -20px;
            padding: 2px 5px;
            font-weight: 600;
        }
        .periodo{
            float: right;
            margin-top: -68px;
            color: #fff;
            background-color: #3E73A0;
            border-radius: 4px;
            box-shadow: 2px 2px 2px #888;
            padding: 0 5px;
            background: url('images/fundoAzulclaro.png') repeat-x right;// bottom;
            background-size: 11px;
        }
        tbody a{
            text-decoration: none;
            font-weight: bolder;
        }
        tbody a:visited{
            color: blue;
        }
        </style>
    </head>
    <body>
    <div id="principal">
        <div class='ocultarCol'>
            <span class=oculTitulo>Ocultar/exibir colinas:<br></span>
        <?php
            $colunas=array('EMISSÃO','NOTA FISCAL','DT PEDIDO','PEDIDO','VL PEDIDO','FORMA PAGAMENTO','ETAPA','VENDEDOR');
            echo '<select id="campoCol">';
                echo '<option id="nenhum"></option>';
                $x=0;
                foreach($colunas as $item){
                    echo "<option class='campoCol' id='$x' >$item</option>";
                    $x++;
                }
            echo '</select>';
        ?>
    </div>
    <div id='linhas'></div>
    <button class='bntNf'>Atualiza STATUS</button>
    <div class='titulo'>PEDIDOS VENDAS</div>
    <table class="periodo" cellspacing="5" cellpadding="5" border="0">
        <tbody>
        <tr>
            <td>Data Inicio:</td>
            <td><input id="min" name="min" type="text"></td>
        </tr>
        <tr>
            <td style='text-align:right'>Data Fim:</td>
            <td><input id="max" name="max" type="text"></td>
        </tr>
    </tbody></table>
    <table class="display" id='tabela1'>
        <thead><tr><th>EMISSÃO</th><th>NOTA FISCAL</th><th>DT PEDIDO</th><th>PEDIDO</th><th>VL PEDIDO</th><th>FORMA PAGAMENTO</th><th>ETAPA</th><th>VENDEDOR</th></tr></thead>
        <tbody>
            <?php
                if(isset($dados)):
                foreach($dados as $key => $item):
                    if($item->getnumero_pedido()):
                        if($key):
                            $item->getdanfe()? $danfe=$item->getdanfe(): $danfe=null;
                            !$danfe && $item->getnumero_nfe()? $cor='red': $cor=null;
                            $danfe? $target='target="_blank"': $target=null;
                            $danfe? $data=$item->getdata_emissao():$data=null;
                        ?>
            <tr style="color: <?= $cor ?>"><td align='center'><?= $data ?></td><td align='right'><a href="<?= $danfe; ?>" <?= $target ?> title="clique para abrir NF-e"><?php $item->getnumero_nfe()? $nfe=intval($item->getnumero_nfe()):$nfe=null; echo $nfe;?></a></td><td align='center'><?= $item->getdPrevisao() ?></td><td align='right'><a href="../paginas/imprime.php?id=<?= $item->getid() ?>&direto=1" target="_blank" title="clique para reimprimir pedido"><?= $item->getnumero_pedido() ?></a></td><td align='right'><?= number_format($item->getvalor_total_pedido(),'2',',','.') ?></td><td><?= $item->getfPagamento() ?></td><td><?= defineEtapa($item->getetapa()) ?></td><td><?= $item->getvendedor() ?></td></tr>
                <?php endif; endif; endforeach; endif;?>
        </tbody>
        <tfoot>
            <tr>
                <th>Parcial:</th>
                <th colspan="3" style='text-align: left'></th>
                <th colspan="4"></th>
            </tr>
        </tfoot>
    </table>
    </div>
    </body>
</html>
