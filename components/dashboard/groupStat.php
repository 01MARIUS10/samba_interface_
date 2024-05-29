<canvas id="groupStat"></canvas>
<script>
    const ctx_groupStat = document.getElementById('groupStat');
    new Chart(ctx_groupStat, {
        type: 'bar',
        data: {
            labels: ['Root', 'Mark', 'Jean', 'Yves', 'Fetra', 'Tanjona'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>