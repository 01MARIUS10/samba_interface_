<?php


function extractUsages($user) {
    return $user['Usage'];
}

function getUsages($users){
    return array_map('extractUsages', $users);
}

function extractNames($user) {
    return $user['Nom'];
}

function getNames($users){
    return array_map('extractNames', $users);
}
$usagesJson = json_encode(getUsages($users));
$namesJson = json_encode(getNames($users));
?>

<canvas id="userStat"></canvas>
<script>
    var usagesData = <?php echo $usagesJson;?>;
    var namesData = <?php echo $namesJson;?>;

    const ctx_userStat = document.getElementById('userStat');

    new Chart(ctx_userStat, {
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