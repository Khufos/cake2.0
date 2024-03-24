$(document).ready(function(){
    var ctx = $("#por_abrigo")
    var mychart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Nº de Desabrigados',
                type: 'line',
                fill: false,
                lineTension: 0,
                borderColor: 'rgb(70,191,19)',
                borderWidth: 2,
                backgroundColor: 'rgb(70,191,19)',
                data: desabrigados
            },{
                label: 'Nº de Novos Abrigados',
                type: 'line',
                fill: false,
                lineTension: 0,
                borderColor: 'rgb(190,19,70)',
                borderWidth: 2,
                backgroundColor: 'rgb(190,19,70)',
                data: aumento
            },{
                label: 'Nº Anterior de abrigados',
                borderColor: '#3B5998',
                borderWidth: 2,
                backgroundColor: '#3B5998',
                data: abrigados_anteriormente
            },{
                label: 'Nº Atual de abrigados',
                borderColor: 'rgb(54,162,235)',
                borderWidth: 2,
                backgroundColor: 'rgb(54,162,235)',
                data: abrigados_atualmente
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            tooltips: {
                mode: 'index'
            },
            responsive: true
        }
    });
})
