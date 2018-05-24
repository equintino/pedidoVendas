<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type='text/javascript' src='js/jquery-1.12.4.js'></script>
        <script type='text/javascript' src='js/jquery.canvasjs.min.js'></script>
        <!--<script type='text/javascript' src='js/chart2.js'></script>-->
        <title>Gráfico</title>
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
                    $vDin?:$vDin=0;
                    @$vDeb=array_sum($dGrafico[$anoSelecionado][$key][$item2]['debito']);
                    $vDeb?:$vDeb=0;
                    @$vCre=array_sum($dGrafico[$anoSelecionado][$key][$item2]['credito']);
                    $vCre?:$vCre=0;
                    
                    @array_push($arrDin,array('x' => $item2,'y' => $vDin));
                    @array_push($arrDeb,array('x' => $item2,'y' => $vDeb));
                    @array_push($arrCre,array('x' => $item2,'y' => $vCre));
                }
                $dataPoints2=$arrDeb;
                $dataPoints1=$arrDin;
                $dataPoints3=$arrCre;
            }
        ?>
        <script>
            /*window.onload = function() {
                var dataPoints = [];
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light2",
                    title: {
                            text: "Gráfico de Vendas"
                    },
                    data: [{
                            type: "line",
                            dataPoints: dataPoints
                    }]
                });
                updateData();
                // Initial Values
                var xValue = 0;
                var yValue = 10;
                var newDataCount = 6;
                function addData(data) {
                    if(newDataCount != 1) {
                        $.each(data, function(key, value) {
                            dataPoints.push({x: value[0], y: parseInt(value[1])});
                            xValue++;
                            yValue = parseInt(value[1]);
                        });
                    } else {
                        //dataPoints.shift();
                        dataPoints.push({x: data[0][0], y: parseInt(data[0][1])});
                        xValue++;
                        yValue = parseInt(data[0][1]);
                    }
                    newDataCount = 1;
                    chart.render();
                    setTimeout(updateData, 500);
                }
                function updateData() {
                    $.getJSON("https://canvasjs.com/services/data/datapoints.php?xstart="+xValue+"&ystart="+yValue+"&length="+newDataCount+"type=json&callback=?", addData);
                }
            }*/
    $(document).ready(function(){
        var mes='/5';
        var grafico = $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    title: {
                        text: "Gráfico de Vendas"
                    },
                    animationEnabled: true,
                    toolTip: {
                        shared: true,
                        content: function (e) {
                            var body;
                            //var head;
                            //head = "<span style = 'color:DodgerBlue; '><strong>dinheiro: R$ " + (e.entries[0].dataPoint.x) + "</strong></span><br/>";

                            body = "<span style= 'color:" + e.entries[0].dataSeries.color + "'> " + e.entries[0].dataSeries.name + "</span>: <strong>R$ " + e.entries[0].dataPoint.y + "</strong>  <br/> <span style= 'color:" + e.entries[1].dataSeries.color + "'> " + e.entries[1].dataSeries.name + "</span>: <strong>R$ " + e.entries[1].dataPoint.y + "</strong> <br/> <span style= 'color:" + e.entries[2].dataSeries.color + "'> " + e.entries[2].dataSeries.name + "</span>: <strong>R$ " + e.entries[2].dataPoint.y + "</strong>";

                            //return (head.concat(body));
                            return body;
                        }
                    },
                    axisY: {
                        title: "R$",
                        includeZero: false,
                        suffix: " ",
                        lineColor: "#369EAD"
                    },
                    /*axisY2: {
                        title: "Distance",
                        includeZero: false,
                        suffix: " m",
                        lineColor: "#C24642"
                    },*/
                    axisX: {
                        title: "Data",
                        suffix: mes,
                        /*prefix: '20'*/
                    },
                    data: [
                    {
                        type: "spline",
                        name: "dinheiro",
                        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "spline",
                        //axisYType: "secondary",
                        name: "débito",
                        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "spline",
                        name: "crédito",
                        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                    },
                    ]
                });
                chart.render();
            });
    });
        </script>
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </body>
</html>
