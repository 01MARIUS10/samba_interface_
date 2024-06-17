<?php
function usagePerSum($user,$min=0){
    if($min){
        return $user['max-usage'];
    }
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
                            <button class="btn btn-primary" 
                            data-toggle="modal" 
                            data-target="#modalModificationUser"
                            data-username=<?= $a['Nom'] ?> 
                            data-groups="<?= $a['Groups'] ?>"
                            data-storage=<?= usagePerSum($a,1) ?> 
                            
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
                <h5 class="modal-title" id="exampleModalLabel">Modification de l'utilisateur <span id="modalName" class='colorN'></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ici, ajoutez votre formulaire de modification -->
                <form>
                    
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

<div class="modal fade" id="modalCreationUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau utilisateur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ici, ajoutez votre formulaire de modification -->
                <form>
                    <div class="form-group">
                        <label for="nomUser">Nom :</label>
                        <input type="email" class="form-control" id="nomUser" placeholder="Entrez le nom">
                    </div>
                    <div class="form-group">
                        <label for="passwdUser">password :</label>
                        <input type="password" class="form-control" id="passwdUser" placeholder="Entrez le passwd">
                    </div>
                    <div class="form-group">
                        <label for="email">groups :</label>
                        <select class="form-select form-control" aria-label="Default select example" id="grpUser">
                            <option selected value="">Entrer vos groups</option>
                            <?php foreach($groups as $g) :?>
                            <option value="<?= $g['Nom']?>"><?= $g['Nom']?></option>
                            <?php endforeach ;?>
                        </select>
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
                <button type="submit" class="btn btn-primary" id="saveUser">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<script>
$(document).ready(function() {
    $('#modalModificationUser').on('shown.bs.modal', function (e) {
        var button = $(e.relatedTarget) // Button that triggered the modal

        // Utilisez $(this) pour accéder au modal
        var username__ = button.data('username'); // Correction ici
        var groups__ =   button.data('groups'); // Correction ici
        var storage__ =  button.data('storage'); // Correction ici
        
        console.log(button.data('username'),username__,'io',$('#modalName'))
        // Mettez à jour les valeurs des champs
        document.querySelector('#modalName').innerText = username__;
        $('#groups').val(groups__);
        $('#floatInput').val(storage__);
    });

    $('#saveUser').click(()=>{
        console.log('click')
        let nUser = document.querySelector('#nomUser').value
        let pUser = document.querySelector('#passwdUser').value
        let gUser = document.querySelector('#grpUser').value
        // console.log(nUser,pUser,gUser)
        // console.log(`http://localhost:8999/api/sambaApi/User/userApi.php?newUser=${nUser}&passwd=${pUser}&group=${gUser}`)

        // `http://localhost:8999/api/FileManager/__getFromPath.php?path=${path}`)
        fetch(`http://localhost:8999/api/sambaApi/User/userApi.php?newUser=${nUser}&passwd=${pUser}`)
            .then(e => e.json())
            .then(res => {console.log(res);window.location.reload()})

    });
});


</script>