<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatórios</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../web/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src='../web/js/jquery-3.2.1.min.js' ></script>
        <script type="text/javascript" src='../web/js/jquery.dataTables.min.js' ></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                var table = $('#tabela1').DataTable({
                    "order": [[ 3, "desc" ]],
                    "columnDefs": [
                            {
                                "targets": [ 1 ],
                                "visible": true,
                                "searchable": true
                            }
                        ],
                    /*"stateSave": true,*/
                    "scrollX": true,
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
                    
                    
                    
                    /*"footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column( 4 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Total over this page
                        pageTotal = api
                            .column( 4, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Update footer
                        $( api.column( 4 ).footer() ).html(
                            '$'+pageTotal +' ( $'+ total +' total)'
                        );
                    }*/
                    
                });
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
                font-family: sans-serif;
                font-size: 30px;
            }
            .oculTitulo{
                font-size: 18px;
            }
            .toggle-vis{
                float: left;
                margin-left: 250px;
            }
        </style>
    </head>
    <body>
    <div id="principal">
    <div class='titulo'>RELATÓRIO GERAL</div>
    <table class="display" id='tabela1'>
        <thead><tr ><th>PEDIDO</th><th>VALOR DO PEDIDO</th><th>FORMA DE PAGAMENTO</th><th>N° DOCUMENTO</th><th>ETAPA</th><th>VENDEDOR</th><th>CLIENTE</th><th>QTD VOLUME</th><th>CÓD PRODUTO</th><th>DESCRIÇÃO</th><th>SERIAL</th><th>TRANSPORTADORA</th></tr></thead>
        <tbody>
            <?php foreach($dados as $key => $item): ?>
            <?php 
                $colunas=array('PEDIDO','VALOR DO PEDIDO','FORMA DE PAGAMENTO','Nº DOCUMENTO','ETAPA','VENDEDOR','CLIENTE','QTD VOLUME','CÓD PRODUTO','DESCRIÇÃO','SERIAL','TRANSPORTADORA');
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
            <tr><td align='center'><?= intval($item->getpedido()); ?></td><td align='right'><?= number_format($item->getvPedido(),'2',',','.'); ?></td><td align='center'><?= $item->getfPagamento() ?></td><td align='center'><?= $item->getdados_adcionais_nf() ?></td><td align='center'><?= $etapa ?></td><td align='center'><?= $item->getvendedor() ?></td><td><?= $item->getcliente() ?></td><td align='center'><?= $item->getqvolume(); ?></td><td><?= str_replace('*/*',' / ',$item->getcodigo_produto()); ?></td><td><?= str_replace('*/*',' / ',$item->getdescricao()); ?></td><td><?= str_replace('*/*',' / ',$item->getobs_item()); ?></td><td><?= $item->gettransportadora(); ?></td></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class='ocultar'>
        <span class=oculTitulo>OCULTAR/EXIBIR COLUNAS:</span><br><br><?php $x=0;foreach($colunas as $item): ?>
        <span class='toggle-vis' col='<?= $x ?>' ><?= $item ?></span>
        <?php $x++;endforeach; ?>
    </div>
    </div>
    </body>
</html>
