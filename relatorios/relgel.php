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
            $.fn.dataTable.Api.register( 'column().data().sum()', function () {
                return this.reduce( function (a,b) {
                    var x = parseFloat( a ) || 0;
                    var y = parseFloat( b ) || 0;
                    return x + y;
                } );
            } );
            /* Custom filtering function which will search data in column four between two values */
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = new Date(formataData($('#min').val()));
                    var max = new Date(formataData($('#max').val()));
                    /*var age = parseFloat( data[0] ) || 0;*/
                    var dat = new Date(formataData(data[0])) || 0;
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
                var table = $('#tabela1').DataTable({
                    "columnDefs": [ 
                            {
                                "searchable": false,
                                "orderable": false,
                                "visible": false,
                                "targets": [14]
                            } 
                        ],
                    /*"autoWidth": true,*/
                    "order": [[ 0, "desc" ]],
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
                            .column( 3 )
                            .data()
                            .sum();
                        pageTotal = api
                            .column( 3, { page: 'current' } )
                            .data()
                            .reduce( function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0 );
                        $( api.column( 1 ).footer() ).html(
                            'R$ '+numeroParaMoeda(pageTotal)+' (Total R$ '+numeroParaMoeda(total)+')'
                        );
                    }
                });
                /*$('#tabela1').css( 'width', '20%' );
                table.columns.adjust().draw();*/
                $('#max, #min').change( function() {
                    table.draw();
                    $( '#linhas' ).text( 'Linhas exibidas: '+ table.column({page:'current'} ).data().length );
                } );
                $('select#campoCol').change(function () {
                    var column = table.column($(':selected').attr('id'));
                    column.visible( ! column.visible() );
                    $(this).val('');
                } );
                $(document).on('keyup click', function(){
                    $( '#linhas' ).text( 'Linhas exibidas: '+ table.column({page:'current'} ).data().length );                   
                });
                /*table.on( 'order.dt search.dt', function () {
                    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();*/
                $('#tabela1 tbody').on( 'mouseover', 'tr', function () {
                    $(this).addClass('selected');
                    $(this).attr('title','Com "UM" clique a CHAVE NF-e será copiada, com um "DUPLO" clique para reimprimir comprovante de venda').css('cursor','pointer');
                    $(this).click(function(){
                        var texto = $(this).attr('id');
                        copyTextToClipboard(texto);
                    });
                } );
                $('#tabela1 tbody').on( 'mouseleave', 'tr', function () {
                    $(this).removeClass('selected');
                } );
                $('#tabela1 tbody').dblclick( function () {
                    var id = table.row('.selected').data()[14];
                    var url='../paginas/imprime.php?id='+id+'&direto=1';
                    window.open(url,'_blank');
                } );
                
                $('#principal').show();
                $('.bntNf').click(function(){
                    $(location).attr('href','notafiscal.php?act=buscaNF');
                });
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
        function copyTextToClipboard(text) {
            if(!text){
                text='Não existe nenhuma chave relacionada.';
            }
            var textArea = document.createElement("textarea");

            textArea.style.position = 'fixed';
            textArea.style.top = 0;
            textArea.style.left = 0;
            textArea.style.width = '2em';
            textArea.style.height = '2em';
            textArea.style.padding = 0;
            textArea.style.border = 'none';
            textArea.style.outline = 'none';
            textArea.style.boxShadow = 'none';
            textArea.style.background = 'transparent';
            textArea.value = text;

            document.body.appendChild(textArea);
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'Chave copiada com sucesso' : 'Nao foi possível copiar a chave';
                console.log(msg);
            } catch (err) {
                console.log('Oops, siga o passo abaixo:');
                window.prompt("Copie para área de transferência: Ctrl+C e tecle Enter", text);
            }

            document.body.removeChild(textArea);
        }

        /*Teste*/
        var copyTest = document.querySelector('.copyTest');
        copyTest.addEventListener('click', function(event) {
        copyTextToClipboard('Teste');
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
            @import url('https://fonts.googleapis.com/css?family=Nunito:600');

            body {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            #principal {
                margin: auto;
                margin-top: -100px;
                width: 1100px;
                display: none;
            }
            .titulo{
                text-align: center;
                margin-left: 370px;
                text-shadow: 1px 1px 2px #888;
                font-family: 'Nunito', sans-serif;
                font-size: 30px;
                width: 300px;
            }
            .oculTitulo{
                font-size: 18px;
            }
            .periodo{
                margin: 20px -5px;
                float: right;
                color: #fff;
                background-color: #3E73A0;
                border-radius: 4px;
                box-shadow: 2px 2px 2px #888;
            }

            .ocultarCol{
                margin-left: -20px;
                position: absolute;
                text-align: right;
                font-family: 'Nunito', sans-serif;
            }
            select#campoCol{
                float: right;
                background-color: #F6F6F6;
            }
            #linhas{
                position: absolute;
                margin-top: 80px;
            }
            .bntNf{
                float: right;
                position: absolute;
                margin: 0px 970px;
                padding: 2px 5px;
                font-weight: 600;
                //text-shadow: 2px 2px 2px gray;
                //background: orange;
            }
            
        </style>
    </head>
    <body>
    <div id="principal">
    <div class='ocultarCol'>
        <span class=oculTitulo>Ocultar/exibir colinas:</span>
        <?php
            $colunas=array('DATA','PEDIDO','VALOR DO PEDIDO','FORMA DE PAGAMENTO','Nº DOCUMENTO','ETAPA','VENDEDOR','CLIENTE','QTD VOLUME','CÓD PRODUTO','DESCRIÇÃO','SERIAL','TRANSPORTADORA');
            echo '<select id="campoCol">';
                echo '<option id="nenhum"></option>';
                $x=0;
                foreach($colunas as $item){
                    echo "<option class='campoCol' id='$x' >$item</option>";
                    $x++;
                }
            echo '</select>';
            include '../dao/CRUDNota.php';
            include '../dao/NotaSearchCriteria.php';
            include '../model/modelNota.php';
            include '../mapping/notaMapper.php';
            $dao2=new CRUDNota();
            $search=new NotaSearchCriteria();
            $search->settabela('tb_nf');
            /*foreach($dados as $key => $item){
                $search->setnIdPedido($item->getcodigo_pedido());
                $dadosNota=$dao2->encontrePorNota($search);
                foreach($dadosNota as $nf){
                    $cChaveNFe=$nf->getcChaveNFe();
                    $nNF=$nf->getnNF();
                    print_r([$cChaveNFe,$nNF]);
                }
            }die;*/
        ?>
    </div>
    <div id='linhas'></div>
    <button class='bntNf'>Atualiza NF-e</button>
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
    <div class='titulo'>RELATÓRIO GERAL</div>
    <table class="display" id="tabela1">
        <thead><tr><th>&nbsp&nbspDATA&nbsp&nbsp</th><th>NOTA FISCAL</th><th>&nbsp PEDIDO &nbsp</th><th>VALOR PEDIDO </th><th>FORMA PAGAMENTO</th><th>N° DOCUMENTO</th><th>&nbsp&nbsp&nbspETAPA &nbsp&nbsp&nbsp&nbsp&nbsp</th><th>VENDEDOR</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp CLIENTE &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>QTD VOLUME</th><th>&nbsp&nbsp&nbsp&nbsp CÓDIGO DO PRODUTO &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp DESCRIÇÃO &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp SERIAL &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp TRANSPORTADORA &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>ID</th></tr></thead>
        <tbody>
            <?php foreach($dados as $key => $item): ?>
            <?php 
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
                $search->setnIdPedido($item->getcodigo_pedido());
                $dadosNota=$dao2->encontrePorNota($search);
                foreach($dadosNota as $nf){
                    $cChaveNFe=$nf->getcChaveNFe();
                    $nNF=intval($nf->getnNF());
                }
            ?>
            <tr id='<?= isset($cChaveNFe)? $cChaveNFe: null; ?>'><td align='center'><?= $item->getdPrevisao(); ?></td><td align='right' ><?= isset($nNF)? $nNF: null; ?></td><td align='center'><?= intval($item->getpedido()); ?></td><td align='right'><?= $item->getvPedido(); ?></td><td align='center'><?= $item->getfPagamento() ?></td><td align='center'><?= $item->getdados_adcionais_nf() ?></td><td align='center'><?= $etapa ?></td><td align='center'><?= $item->getvendedor() ?></td><td><?= $item->getcliente() ?></td><td align='center'><?= $item->getqvolume(); ?></td><td><?= str_replace('*/*',' / ',$item->getcodigo_produto()); ?></td><td><?= str_replace('*/*',' / ',$item->getdescricao()); ?></td><td><?= str_replace('*/*',' / ',$item->getobs_item()); ?></td><td><?= $item->gettransportadora(); ?></td><td><?= $item->getid() ?></td></tr>
            <?php unset($cChaveNFe,$nNF); endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Parcial:</th>
                <th colspan="3" style='text-align: left'></th>
                <th colspan="6"></th>
            </tr>
        </tfoot>
    </table>
    </div>
    </body>
</html>