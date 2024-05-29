<?php
function usagePerSum($user){
    return $user['Usage']." / ".$user['max-usage']."  (giga)";
}
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">UID</th>
            <th scope="col">Groups</th>
            <th scope="col">Usage</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $a) : ?>
            <tr>
                <th scope="row"><?= $a['id'] ?></th>
                <td><?= $a['Nom'] ?></td>
                <td><?= $a['UID'] ?></td>
                <td><?= $a['Groups'] ?></td>
                <td><?= usagePerSum($a) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>