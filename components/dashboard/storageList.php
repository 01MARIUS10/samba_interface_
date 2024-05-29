<div id="storageList"></div>
<script>
    var fileManager = new ej.filemanager.FileManager({
        ajaxSettings: {
            url: '/api/FileManager/FileOperations.php', // Pointez vers votre backend pour les opérations de fichiers
            getImageUrl: '/api/FileManager/GetImage.php', // URL pour obtenir les images
            uploadUrl: '/api/FileManager/Upload.php', // URL pour uploader des fichiers
            downloadUrl: '/api/FileManager/Download.php' // URL pour télécharger des fichiers
        },
        view: 'Details'
    });
    fileManager.appendTo('#storageList');
</script>