<?php

$postData = json_decode(file_get_contents('php://input'), true);
$_POST = $postData;
// echo(json_encode(["POST"=>$_POST['action']]));die();

// Définir le chemin vers le dossier où les fichiers seront stockés
$folderPath = '/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_';

// Vérifier si c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'action depuis la requête
    $action = $_POST['action'];


    switch ($action) {
        case 'list':
            // Retourner la liste des fichiers
            $files = scandir($folderPath);
            echo json_encode($files);
            break;
        case 'download':
            // Gérer le téléchargement
            $file = $_POST['fileName'];
            if (file_exists("$folderPath/$file")) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                readfile("$folderPath/$file");
                exit;
            }
            break;
        case 'upload':
            // Gérer l'upload
            $file = $_FILES['file'];
            $target_file = "$folderPath/". basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "Fichier téléchargé avec succès.";
            } else {
                echo "Erreur lors du téléchargement du fichier.";
            }
            break;
        case 'read': // Ajout de la gestion pour l'action "read"
            // Gérer la lecture
            $path = isset($postData['path'])? $postData['path'] : '/';
            $showHiddenItems = isset($postData['showHiddenItems'])? $postData['showHiddenItems'] : false;

            // Vérifier si le chemin est valide
            $fullPath = realpath($folderPath. $path);
            if ($fullPath === false || strpos($fullPath, $folderPath)!== 0) {
                echo json_encode(['error' => 'Access denied for Directory-traversal.']);
                exit;
            }

            // Lister les fichiers et dossiers
            $files = [];
            if (is_dir($fullPath)) {
                $files = scandir($fullPath);
                if (!$showHiddenItems) {
                    $files = array_filter($files, function($item) {
                        return!strpos($item, '.');
                    });
                }
            } elseif (is_file($fullPath)) {
                // Lire le contenu du fichier si nécessaire
                $content = file_get_contents($fullPath);
                $files[] = ['name' => basename($fullPath), 'size' => filesize($fullPath), 'content' => $content];
            }

            echo json_encode(['cwd' => $files]);
            break;
        default:
            echo "Action non reconnue.";
            break;
    }
} else {
    echo "Méthode HTTP non autorisée.";
}
?>
