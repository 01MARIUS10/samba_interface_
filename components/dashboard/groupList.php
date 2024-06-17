<?php
require_once './data.php';
function isGroupPage()
{
    return  $_SERVER['REQUEST_URI'] === "/groups.php" ? true : false;
}

?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">GID</th>
            <th scope="col">users</th>
            <th scope="col">path</th>
            <th scope="col">created_at</th>
            <?php if (isGroupPage()) : ?>
                <th scope="col">action</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $a) : ?>
            <tr>
                <th scope="row"><?= $a['id'] ?></th>
                <td><?= $a['Nom'] ?></td>
                <td><?= $a['GID'] ?></td>
                <td><?= $a['Users'] ?></td>
                <td><?= $a['Path'] ?></td>
                <td><?= $a['created_at'] ?></td>
                <?php if (isGroupPage()) : ?>
                    <td style="width:230px;">
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalModificationGroup"> modifier</button>
                            <button class="btn btn-danger"> supprimer</button>
                        </div>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php if (isGroupPage()) : ?>
<!-- Structure de la fenêtre modale -->
<div class="modal fade" id="modalModificationGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modification du groupe</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Ici, ajoutez votre formulaire de modification -->
				<form>
					<div class="form-group">
						<label for="nom">Nom du group:</label>
						<input type="text" class="form-control" id="nom" placeholder="Entrez le nom">
					</div>
					<div class="form-group">
						<label for="email">users :</label>
						<input type="email" class="form-control" id="email" placeholder="Entrez les utilisateurs">
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


<div class="modal fade" id="modalCreationGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau groupe </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ici, ajoutez votre formulaire de modification -->
                <form>
                    <div class="form-group">
                        <label for="nomGroup">Nom :</label>
                        <input type="email" class="form-control" id="nomGroup" placeholder="Entrez le nom">
                    </div>
                    <div class="form-group">
                        <label for="pathGroup">password :</label>
                        <input type="text" class="form-control" id="pathGroup" placeholder="Entrez le path">
                    </div>

                    <!-- Ajoutez d'autres champs selon besoin -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="saveGroup">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<script>
$(document).ready(function() {
    $('#modalModificationGroup').on('shown.bs.modal', function (e) {
        var button = $(e.relatedTarget) // Button that triggered the modal

        console.log('get data')
        // Utilisez $(this) pour accéder au modal
        // var username__ = button.data('username'); // Correction ici
        // var groups__ =   button.data('groups'); // Correction ici
        // var storage__ =  button.data('storage'); // Correction ici
        
        // console.log(button.data('username'),username__,'io',$('#modalName'))
        // Mettez à jour les valeurs des champs
        // document.querySelector('#modalName').innerText = username__;
        // $('#groups').val(groups__);
        // $('#floatInput').val(storage__);
    });

    $('#saveGroup').click(()=>{
        console.log('click')
        // let nUser = document.querySelector('#nomUser').value
        // let pUser = document.querySelector('#passwdUser').value
        // let gUser = document.querySelector('#grpUser').value
        // // console.log(nUser,pUser,gUser)
        // fetch(`http://localhost:8999/api/sambaApi/User/userApi.php?newUser=${nUser}&passwd=${pUser}`)
        //     .then(e => e.json())
        //     .then(res => {console.log(res);window.location.reload()})

    });
});


</script>