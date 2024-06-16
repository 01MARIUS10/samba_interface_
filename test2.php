<?php
// Supposons que l'URL est passée en paramètre ou récupérée d'une autre manière
$url = "http://localhost:8999/api/FileManager/__createFolder.php?path=%27/var/share";

// Récupérer le paramètre 'path' de l'URL
$path = parse_url($url, PHP_URL_QUERY);

// Décoder le paramètre 'path' pour obtenir la valeur brute
$decodedPath = urldecode($path);

// Supprimer l'apostrophe initial de la chaîne
$finalPath = substr($decodedPath, 1);

echo $finalPath; // Affiche "/var/share"



// $pipes = array(
//     0 => array("pipe", "r"),  // stdin
//     1 => array("pipe", "w"),  // stdout
//     2 => array("pipe", "w")   // stderr
// );

// $process = proc_open('passwd toto', $pipes);

// if ($process === false) {
//     die('Erreur de l\'exécution de la commande');
// }

// $stdout = stream_get_contents($pipes[1]);
// $stderr = stream_get_contents($pipes[2]);

// fclose($pipes[1]);
// fclose($pipes[2]);

// proc_close($process);

// echo $stdout; // Affiche la sortie standard
// echo $stderr; // Affiche la sortie d'erreur



?>