<?php
// Chemin vers le dossier où les images sont stockées
$folderPath = '/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_';

// Nom de l'image demandée
$imageName = $_GET['imageName'];

// Construire le chemin complet de l'image
$imagePath = "$imageFolderPath/$imageName";

// Vérifier si l'image existe
if (file_exists($imagePath)) {
    // Définir le type MIME de l'image
    $mime_type = mime_content_type($imagePath);

    // Envoyer l'image au client
    header("Content-Type: $mime_type");
    readfile($imagePath);
} else {
    http_response_code(404);
    echo "L'image demandée n'existe pas.";
}
?>
