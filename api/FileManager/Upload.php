<?php
$targetDir = "chemin/vers/vos/fichiers/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir. $fileName;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
    echo json_encode(["success" => true, "message" => "Fichier téléchargé avec succès."]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors du téléchargement du fichier."]);
}
?>
