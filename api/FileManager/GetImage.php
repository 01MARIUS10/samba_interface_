<?php
$filePath = 'chemin/vers/votre/image.jpg'; // Spécifiez le chemin de votre image
header("Content-Type: image/jpeg");
readfile($filePath);
?>
