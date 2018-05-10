<!DOCTYPE html>

<html lang="pt-br">
    <head></head>
    <body>
    <?php include 'menu.php' ?>
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
                                label: "DINHEIRO ("+tDinheiro+")",
                                data: [dinSeg,dinTer,dinQua,dinQui,dinSex,dinSab,],
                                borderWidth: 6,
                                borderColor: 'rgba(45,255,45,0.85)',
                                backgroundColor: 'transparent',
                            },
                            ]
                        },

                        options: {
                            title: {
                            display: true,
                            fontSize: 20,
                            text: "RELATÓRIO SEMANAL DE "+dSeg+" A "+dSab+""
                            },
                            labels: {
                                fontStyle: "bold"
                            }
                        }
                    });
                </script>
    </body>
</html>