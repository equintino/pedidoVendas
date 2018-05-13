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
            /* Custom filtering function which will search data in column four between two values */
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = new Date($('#min').val());
                    var max = new Date($('#max').val());
                    /*var age = parseFloat( data[0] ) || 0;*/
                    var dat = new Date(data[0]) || 0;
                    
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
            $(document).ready(function(){
                $('#min').datepicker({dateFormat: 'dd/mm/yy'});
                $('#max').datepicker({dateFormat: 'dd/mm/yy'});
                $('#min').change(function(){
                    
                    //alert(dMin);
                    /*dataMin=filtroData($('#min').val());
                    $('#min').attr('dMin',dataMin);
                    alert($('#min').attr('dMin'));*/
                })
                /*$('#max').change(function(){
                    dataMax=filtroData($('#max').val());
                    $('#max').attr('dMax',dataMax);
                })*/
                var table = $('#tabela1').DataTable({
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                            {
                                "targets": [ 0 ],
                                "visible": true,
                                "searchable": true
                            }
                        ],
                    "scrollX": true,
                    "language": {
                            "decimal": ",",
                            "thousands": "."
                        },
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
                            .column( 1 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        pageTotal = api
                            .column( 1, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        $( api.column( 1 ).footer() ).html(
                            'R$ '+numeroParaMoeda(pageTotal)+' (Total R$ '+numeroParaMoeda(total)+')'
                        );
                    }
                });
                    // Event listener to the two range filtering inputs to redraw on input
                $('#max, #min').change( function() {
                    //alert(filtroData($('#max').val()));
                    //alert(table);
                    table.draw();
                } );
                $('.toggle-vis').mouseover(function(){
                    $(this).css('cursor','pointer');
                });
                $('.toggle-vis').on( 'click', function (e) {
                    e.preventDefault();
                    var column = table.column($(this).attr('col'));
                    if($(this).css('color')=='rgb(0, 0, 0)'){
                        $(this).css({
                            color:'#ccc'
                        }); 
                    }else{
                        $(this).css({
                            color:'rgb(0, 0, 0)'
                        });
                    }
                    column.visible( ! column.visible() );
                } );
                $('#principal').show();
            });
        function numeroParaMoeda(n, c, d, t){
            c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");    
        } 
        function filtroData(str){
            var ano = str.substr(-4,4);
            var mes = str.substr(3,2);
            var dia = str.substr(0,2);
            var str = ano+'/'+mes+'/'+dia;
            return str;
        }
        </script>
        <?php 
            include 'menu.php';
            include 'relatorio.php';
            
            echo '<pre>';
            $search->setdSemana(null);
            $dados=$dao->encontrePorPedido($search);
        ?> 
        <style type="text/css">
            #principal {
                margin: auto;
                margin-top: -100px;
                width: 1100px;
                display: none;
            }
            .titulo{
                text-align: center;
                margin-left: 200px;
                font-family: sans-serif;
                font-size: 30px;
            }
            .oculTitulo{
                font-size: 18px;
            }
            .periodo{
                float: right;
            }
        </style>
    </head>
    <body>
    <div id="principal">
    <table class="periodo" cellspacing="5" cellpadding="5" border="0">
        <tbody><tr>
            <td>Data Inicio:</td>
            <td><input id="min" name="min" type="text"></td>
        </tr>
        <tr>
            <td style='text-align:right'>Data Fim:</td>
            <td><input id="max" name="max" type="text"></td>
        </tr>
    </tbody></table>
    <div class='titulo'>RELATÓRIO GERAL</div>
    <table class="display" id="tabela1">
        <thead><tr><th>DATA</th><th>PEDIDO</th><th>VALOR DO PEDIDO</th><th>FORMA DE PAGAMENTO</th><th>N° DOCUMENTO</th><th>ETAPA</th><th>VENDEDOR</th><th>CLIENTE</th><th>QTD VOLUME</th><th>CÓD PRODUTO</th><th>DESCRIÇÃO</th><th>SERIAL</th><th>TRANSPORTADORA</th></tr></thead>
        <tbody>
            <?php foreach($dados as $key => $item): ?>
            <?php 
                $colunas=array('DATA','PEDIDO','VALOR DO PEDIDO','FORMA DE PAGAMENTO','Nº DOCUMENTO','ETAPA','VENDEDOR','CLIENTE','QTD VOLUME','CÓD PRODUTO','DESCRIÇÃO','SERIAL','TRANSPORTADORA');
                if($item->getetapa()){
                    switch($item->getetapa()){
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
                        case 60:
                            $etapa='Entrega';
                            break;
                    }
                }
            ?>
            <tr><td align='center'><?= $item->getdPrevisao(); ?></td><td align='center'><?= intval($item->getpedido()); ?></td><td align='right'><?= $item->getvPedido(); ?></td><td align='center'><?= $item->getfPagamento() ?></td><td align='center'><?= $item->getdados_adcionais_nf() ?></td><td align='center'><?= $etapa ?></td><td align='center'><?= $item->getvendedor() ?></td><td><?= $item->getcliente() ?></td><td align='center'><?= $item->getqvolume(); ?></td><td><?= str_replace('*/*',' / ',$item->getcodigo_produto()); ?></td><td><?= str_replace('*/*',' / ',$item->getdescricao()); ?></td><td><?= str_replace('*/*',' / ',$item->getobs_item()); ?></td><td><?= $item->gettransportadora(); ?></td></tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Parcial:</th>
                <th colspan="3" style='text-align: left'></th>
                <th colspan="6"></th>
            </tr>
        </tfoot>
    </table>
    <div class='ocultarCol'>
        <span class=oculTitulo>OCULTAR/EXIBIR COLUNAS:</span>
        <!--<span class='toggle-vis' col="0">PEDIDO,</span><span class='toggle-vis' col="1">VALOR DO PEDIDO,</span><span class='toggle-vis' col="2">FORMA DE PAGAMENTO,</span><span class='toggle-vis' col="3">Nº DOCUMENTO,</span><span class='toggle-vis' col="4">ETAPA,</span><span class='toggle-vis' col="5">VENDEDOR,</span><span class='toggle-vis' col="6">CLIENTE,</span><span class='toggle-vis' col="7">QTD VOLUME,</span><span class='toggle-vis' col="8">CÓD PRODUTO,</span><span class='toggle-vis' col="9">DESCRIÇÃO,</span><span class='toggle-vis' col="10">SERIAL,</span><span class='toggle-vis' col="11">TRANSPORTADORA</span>-->
        <?php $x=0;foreach($colunas as $item): ?>
        <span class='toggle-vis' col='<?= $x ?>' ><?= $item ?></span>
        <?php $x++;endforeach; ?>
    </div>
    </div>
    </body>
</html>
