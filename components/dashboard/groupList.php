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
<?php endif ?>