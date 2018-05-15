/*variáveis dinheiro*/
var dinSeg;
var dinTer;
var dinQua;
var dinQui;
var dinSex;
var dinSab;
/*variáveis débito*/
var debSeg;
var debTer;
var debQua;
var debQui;
var debSex;
var debSab;

/*variáveis crédito*/
var credSeg;
var credTer;
var credQua;
var credQui;
var credSex;
var credSab;

/* semana */
var dSeg;
var dSab;
var tDinheiro;
var tDebito;
var tCredito;
/*Gráfico*/
var ctx = document.getElementsByClassName("line-chart");

            var chartGraph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Seg","ter","Quar","Qui","Sex","Sab"],
                    datasets: [{
                        label: "DINHEIRO ("+tDinheiro+")",
                        data: [dinSeg,dinTer,dinQua,dinQui,dinSex,dinSab],
                        borderWidth: 6,
                        borderColor: 'rgba(45,255,45,0.85)',
                        backgroundColor: 'transparent',
                    },
                    {
                        label: "DÉBITO ("+tDebito+")",
                        data: [debSeg,debTer,debQua,debQui,debSex,debSab],
                        borderWidth: 6,
                        borderColor: 'rgba(77,166,253,0.85)',
                        backgroundColor: 'transparent'
                    },

                    {
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
                        text: "RELATÓRIO SEMANAL DE "+dSeg+" A "+dSab+""
                    },
                    labels: {
                        fontStyle: "bold"
                    }
                }
            })