<?php
// $output = shell_exec('passwd toto');
$newPass = "re345_re3re";
// $output = shell_exec("echo '$newPass' | echo toto ");
$output = shell_exec("echo '$newPass' | echo '$newPass' | passwd toto");

echo "$output";


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