<?php
// Chemin vers le dossier où les fichiers seront stockés
$folderPath = '/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_';

// Vérifier si un fichier a été posté
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $target_file = "$folderPath/" . basename($file["name"]);

    // Valider le fichier (exemple simplifié)
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "Fichier uploadé avec succès.";
    } else {
        echo "Erreur lors de l'upload du fichier.";
    }
} else {
    echo "Aucun fichier n'a été posté.";
}
?>