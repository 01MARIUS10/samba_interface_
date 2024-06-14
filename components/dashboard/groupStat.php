<?php

function extractUsages_($groups) {
    return $groups['storage'];
}

function getUsages_($groups){
    return array_map('extractUsages_', $groups);
}

function extractNames_($groups) {
    return $groups['Nom'];
}

function getNames_($groups){
    return array_map('extractNames_', $groups);
}
$usagesJson_ = json_encode(getUsages_($groups));
$namesJson_ = json_encode(getNames_($groups));

?>
<canvas id="groupStat"></canvas>
<script>
    var usagesData = <?php echo $usagesJson_;?>;
    var namesData  = <?php echo $namesJson_ ;?>;
    const ctx_groupStat = document.getElementById('groupStat');
    new Chart(ctx_groupStat, {
        type: 'bar',
        data: {
            labels: namesData,
            datasets: [{
                label: '# of Votes',
                data: usagesData,
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