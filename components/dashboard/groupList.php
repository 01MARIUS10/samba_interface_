<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">GID</th>
            <th scope="col">users</th>
            <th scope="col">created_at</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $a) : ?>
            <tr>
                <th scope="row"><?= $a['id'] ?></th>
                <td><?= $a['Nom'] ?></td>
                <td><?= $a['GID'] ?></td>
                <td><?= $a['Users'] ?></td>
                <td><?= $a['created_at'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>