<canvas id="storageStat"></canvas>
<!-- <div id="container"></div> -->

<script>
    let chartInstance = null; // Variable globale pour stocker l'instance du graphique

    function getRandomRgb() {
        var num = Math.round(0xffffff * Math.random());
        var r = num >> 16;
        var g = num >> 8 & 255;
        var b = num & 255;
        return 'rgb(' + r + ', ' + g + ', ' + b + ')';
    }

    function getCharFormatData() {
        return {
            label: fileAndFolder.map(i => i.name),
            data: fileAndFolder.map(i => i.size),
            backgroundColor: fileAndFolder.map(i => getRandomRgb())
        };
    }

    function executeChart() {
        fromage = getCharFormatData()
        console.log("fromage", fromage)
        const ctx_storageStat = document.getElementById('storageStat');
        // Destruction du graphique précédemment créé si existant
        if (chartInstance !== null) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx_storageStat, {
            type: 'pie',
            data: {
                labels: fromage.label,
                datasets: [{
                    label: 'espacement ',
                    data: fromage.data,
                    backgroundColor: fromage.backgroundColor,
                    hoverOffset: 4
                }]
            },
        })
    }
</script>