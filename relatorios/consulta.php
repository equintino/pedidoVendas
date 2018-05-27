<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.min.css' />
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.structure.min.css' />
        <link rel='stylesheet' type='text/css' href='css/jquery-ui.theme.min.css' />
        <script type='text/javascript' src='js/jquery-1.12.4.js'></script>
        <script type='text/javascript' src='js/jquery.canvasjs.min.js'></script>
        <script type='text/javascript' src='js/jquery-ui.min.js'></script>
        <title>Gráfico</title>
        <script>
            function formataData(str){
                var dia=str.substr(0,2);
                var mes=str.substr(3,2);
                var ano=str.substr(-4,4);
                return new Date(ano+'/'+mes+'/'+dia);
            }
            $(document).ready(function(){
                for(i in dataPoints1){
                    for(s in dataPoints1[i]){
                        dataPoints1[i]['x']=new Date(dataPoints1[i]['x']);
                    }
                }
                for(i in dataPoints2){
                    for(s in dataPoints2[i]){
                        dataPoints2[i]['x']=new Date(dataPoints2[i]['x']);
                    }
                }
                for(i in dataPoints3){
                    for(s in dataPoints3[i]){
                        dataPoints3[i]['x']=new Date(dataPoints3[i]['x']);
                    }
                }
                var dMin=null;
                var dMax=null;
                $('#min').datepicker({dateFormat: 'dd/mm/yy'});
                $('#max').datepicker({dateFormat: 'dd/mm/yy'});
                var mes='';
                window.onload = function grafico() {
                    var options = {
                        exportEnabled: true,
                        animationEnabled: true,
                        title:{
                                text: "Gráfico de Vendas"
                        },
                        subtitles: [{
                                text: "Clique na Legenda para Ocultar ou Exibir Dados"
                        }],
                        axisX: {
                                title: "Data da Venda",
                                minimum: dMin,
                                maximum: dMax,
                                suffix: mes
                        },
                        axisY: {
                                title: "Valores",
                                titleFontColor: "#4F81BC",
                                lineColor: "#4F81BC",
                                labelFontColor: "#4F81BC",
                                tickColor: "#4F81BC",
                                includeZero: false
                        },
                        toolTip: {
                                shared: true,
                                content: function (e) {
                                    var body;
                                    var head;
                                    //head = "<span style = 'color:black; '><strong>Dia " + (e.entries[0].dataPoint.x) + "</strong></span><br/>";

                                    body = "<span style= 'color:" + e.entries[0].dataSeries.color + "'> " + e.entries[0].dataSeries.name + "</span>: R$ " + numeroParaMoeda(e.entries[0].dataPoint.y) + "<br/> <span style= 'color:" + e.entries[1].dataSeries.color + "'> " + e.entries[1].dataSeries.name + "</span>: R$ " + numeroParaMoeda(e.entries[1].dataPoint.y) + "<br/> <span style= 'color:" + e.entries[2].dataSeries.color + "'> " + e.entries[2].dataSeries.name + "</span>: R$ " + numeroParaMoeda(e.entries[2].dataPoint.y) + "";
                                    //return (head.concat(body));
                                    return body;
                                },
                        },
                        legend: {
                                cursor: "pointer",
                                itemclick: toggleDataSeries
                        },
                        data: [{
                                type: "spline",
                                name: "dinheiro",
                                showInLegend: true,
                                xValueFormatString: "MMM YYYY",
                                dataPoints: dataPoints1
                        },
                        {
                                type: "spline",
                                name: "débito",
                                showInLegend: true,
                                xValueFormatString: "MMM YYYY",
                                dataPoints: dataPoints2
                        },
                        {
                                type: "spline",
                                name: "crédito",
                                showInLegend: true,
                                xValueFormatString: "MMM YYYY",
                                dataPoints: dataPoints3
                        }]
                    };
                    $("#chartContainer").CanvasJSChart(options);
                    $('#min, #max').change(function(e){
                        dMin=formataData($('#min').val());
                        dMax=formataData($('#max').val());
                        //dMin=$('#min').val().substr(0,2);
                        //dMax=$('#max').val().substr(0,2);
                        grafico();
                    });
                    function toggleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                        } else {
                                e.dataSeries.visible = true;
                        }
                        e.chart.render();
                    }
                }
            });

            function numeroParaMoeda(n, c, d, t){
                c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");    
            } 
        </script>
        <style>
            .ano{
                float: right;
                font-size: 20px;
                margin-top: -90px;
            }
            #principal {
                margin: auto;
                width: 1100px;
            }
            .graf{
                margin-top: 100px;       
            }
            .periodo{
                margin-top: -60px;
                float: right;
                color: #fff;
                background-color: #3E73A0;
                border-radius: 4px;
                box-shadow: 2px 2px 2px #888;
                background: url('images/fundoAzulclaro.png') repeat-x right;
                background-size: 11px;
            }
        </style>
        <?php
            include 'relatorio.php';
            $search->setdSemana(null);
            $dSem=$dao->encontrePorPedido($search,'asc');
            foreach($dSem as $item){
                $dia=substr($item->getdPrevisao(),0,2);
                $mes=substr($item->getdPrevisao(),3,2);
                $ano=substr($item->getdPrevisao(),-4,4);
                $dGrafico[$ano][$mes][$dia][$item->getfPagamento()][]=$item->getvpedido();
            }
            $anoSelecionado='2018';
            foreach($dGrafico[$anoSelecionado] as $key => $item){
                $dias=array_keys($item);
                $arrDin=$arrDeb=$arrCre=array();
                foreach($dias as $item2){
                    $vDin=array_sum($dGrafico[$anoSelecionado][$key][$item2]['dinheiro']);
                    //$resultado = (date(2018-12-31) - date(2018-12-20));
                    //echo $resultado;die;

                    //echo date("2017-12-31")-date("2017-08-01").'<br>';die;
                    //die;
                    $vDin?:$vDin=0;
                    @$vDeb=array_sum($dGrafico[$anoSelecionado][$key][$item2]['debito']);
                    $vDeb?:$vDeb=0;
                    @$vCre=array_sum($dGrafico[$anoSelecionado][$key][$item2]['credito']);
                    $vCre?:$vCre=0;
                    
                    @array_push($arrDin,array("x" => $anoSelecionado.','.$key.','.$item2,"y" => $vDin));
                    @array_push($arrDeb,array('x' => $anoSelecionado.','.$key.','.$item2,'y' => $vDeb));
                    @array_push($arrCre,array('x' => $anoSelecionado.','.$key.','.$item2,'y' => $vCre));
                }
                $dataPoints1=$arrDin;
                $dataPoints2=$arrDeb;
                $dataPoints3=$arrCre;
            }
                //print_r($dataPoints1);die;
                $dataPoints1_=json_encode($dataPoints1, JSON_NUMERIC_CHECK);
                $dataPoints2_=json_encode($dataPoints2, JSON_NUMERIC_CHECK);
                $dataPoints3_=json_encode($dataPoints3, JSON_NUMERIC_CHECK);
                //print_r($dataPoints1_);
                /*function mesNome($str){
                    switch($str){
                        case 01:
                            $str='Jan';
                            break;
                        case 02:
                            $str='Fev';
                            break;
                        case 03:
                            $str='Mar';
                            break;
                        case 04:
                            $str='Abr';
                            break;
                        case 05:
                            $str='Mai';
                            break;
                        case 06:
                            $str='Jun';
                            break;
                        case 07:
                            $str='Jul';
                            break;
                        case 08:
                            $str='Ago';
                            break;
                        case 09:
                            $str='Set';
                            break;
                        case 10:
                            $str='Out';
                            break;
                        case 11:
                            $str='Nov';
                            break;
                        case 12:
                            $str='Dez';
                            break;
                        return $str;
                    }
                }*/
        ?>
        <script>var dataPoints1=<?= $dataPoints1_ ?>;var dataPoints2=<?= $dataPoints2_ ?>;var dataPoints3=<?= $dataPoints3_ ?>;</script>
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        <div id='principal'>
            <div class='ano'>Ano: <?= $anoSelecionado ?></div>
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
            <div class='graf'>
                <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
        </div>
    </body>
</html>
