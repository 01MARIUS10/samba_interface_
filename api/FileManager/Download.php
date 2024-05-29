<?php
$filePath = 'FileManager/Rapport.pdf'; // Spécifiez le chemin de votre fichier
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: '. filesize($filePath));
readfile($filePath);
exit;
?>
