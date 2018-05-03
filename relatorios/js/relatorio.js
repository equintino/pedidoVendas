var ctx = document.getElementsByClassName("line-chart");

            var chartGraph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Seg","ter","Quar","Qui","Sex","Sab"],
                    datasets: [{
                        label: "DINHEIRO",
                        data: [30,50,25,45,15,56],
                        borderWidth: 6,
                        borderColor: 'rgba(45,255,45,0.85)',
                        backgroundColor: 'transparent',
                    },
                    {
                        label: "DÉBITO",
                        data: [20,45,50,34,45,20],
                        borderWidth: 6,
                        borderColor: 'rgba(77,166,253,0.85)',
                        backgroundColor: 'transparent'
                    },

                    {
                        label: "CRÉDITO",
                        data: [15,16,40,20,10,45],
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
                        text: "RELATÓRIO SEMANAL"
                    },
                    labels: {
                        fontStyle: "bold"
                    }
                }
            })