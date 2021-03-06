<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <?php 
        include 'menu.php';
        include 'relatorio.php';
    ?>         
    </head>
    <body>
        <div id="canvas">
                <canvas class="line-chart"></canvas>
                <script src="js/Chart.min.js"></script>        
                <script>
                    var ctx = document.getElementsByClassName("line-chart");
        
                    var chartGraph = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Seg","ter","Quar","Qui","Sex","Sab"],
                            datasets: [{
                                label: "CRÉDITO ("+tCredito+")",
                                data: [credSeg,credTer,credQua,credQui,credSex,credSab],
                                borderWidth: 6,
                                borderColor: 'rgba(225,60,60,0.85)',
                                backgroundColor: 'transparent'
                            },
                            ]
                },

                            options: {
                        title: {
                        display: true,
                        fontSize: 20,
                        text: "RELATÓRIO SEMANAL "+dSeg+" A "+dSab+""
                    },
                    labels: {
                        fontStyle: "bold"
                    }
                }
            })
        </script>
        </body>
</html>