<canvas id="storageStat"></canvas>
<!-- <div id="container"></div> -->

<script>
    const ctx_storageStat = document.getElementById('storageStat');
    new Chart(ctx_storageStat, {
        type: 'pie',
        data: {
            labels: [
                'Print$',
                'share',
                'smb'
            ],
            datasets: [{
                label: 'espacement ',
                data: [50, 350, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
    })

// var pie = new ej.charts.AccumulationChart({
//             series: [
//                 {
//                     dataSource: [
//                         { 'x': 'Chrome', y: 37 },
//                         { 'x': 'UC Browser', y: 17 },
//                         { 'x': 'iPhone', y: 19 },
//                         { 'x': 'Others', y: 4 },
//                         { 'x': 'Opera', y: 11 },
//                         { 'x': 'Android', y: 12 }
//                     ],
//                     xName: 'x',
//                     yName: 'y',
//                 }
//             ],
//         });
//         pie.appendTo('#container');
</script>