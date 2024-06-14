<?php
function usagePerSum($user){
    return $user['Usage']." / ".$user['max-usage']."  (giga)";
}
function isUserPage()
{
    return  $_SERVER['REQUEST_URI'] === "/users.php" ? true : false;
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
            <?php if (isUserPage()) : ?>
                <th>action</th>
            <?php endif ?>
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
                <?php if (isUserPage()) : ?>
                    <td style="width:230px;">
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalModificationUser"
                            data-username=<?= $a['Nom'] ?> 
                            data-groups=<?= $a['Groups'] ?> 
                            data-storage=<?= usagePerSum($a) ?> 
                            
                            > modifier</button>
                            <button class="btn btn-danger"> supprimer</button>
                        </div>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>



<?php if (isUserPage()) : ?>
<!-- Structure de la fenêtre modale -->
<div class="modal fade" id="modalModificationUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modification de l'utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ici, ajoutez votre formulaire de modification -->
                <form>
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="username" placeholder="Entrez le nom">
                    </div>
                    <div class="form-group">
                        <label for="email">groups :</label>
                        <input type="email" class="form-control" id="groups" placeholder="Entrez les groups">
                    </div>
                    <div class="form-group">
                        <label for="floatInput">stockage disponible :</label>
                        <input type="number" step="any" min="0" max="10000000" class="form-control" id="floatInput" placeholder="Entrez le stockage">
                    </div>

                    <!-- Ajoutez d'autres champs selon besoin -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<script>
    $(document).ready(function() {
        document.addEventListener('DOMContentLoaded', function() {
            $('#modalModificationUser').on('shown.bs.modal', function () {
                console.log($(this))
                var username__ = $(this).data('target').attr('data-username');
                var groups__ = $(this).data('target').attr('data-groups');
                var storage__ = $(this).data('target').attr('data-storage');
                document.querySelector('#username').value = username__
                document.querySelector('#groups').value = groups__
                document.querySelector('#floatInput').value = storage__
            });
        })
});

</script>