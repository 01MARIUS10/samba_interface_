<?php
// Chemin vers le dossier où les fichiers sont stockés
$folderPath = '/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_';

// Nom du fichier demandé
$fileName = $_GET['fileName'];

// Construire le chemin complet du fichier
$filePath = "$folderPath/$fileName";

// Vérifier si le fichier existe
if (file_exists($filePath)) {
    // Définir le type MIME du fichier
    $mime_type = mime_content_type($filePath);

    // Créer un nom de fichier unique pour éviter les conflits
    $uniqueFileName = uniqid() . '_' . basename($filePath);

    // Déplacer temporairement le fichier dans un dossier de téléchargement
    rename($filePath, "chemin_temporaire/$uniqueFileName");

    // Rediriger vers le fichier téléchargeable
    header("Location: /chemin_temporaire/$uniqueFileName");
    exit;
} else {
    http_response_code(404);
    echo "Le fichier demandé n'existe pas.";
}
