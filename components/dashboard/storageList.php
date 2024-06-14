<div id="storageList" class="w-100 h-100">
    <div class="storageContent d-flex flex-column w-100 h-100">
        <div class="action d-flex p-2">
            <span>cree un dossier</span>
            <span>upload</span>
            <span>refresh</span>
        </div>
        <div class="storageContent_ d-flex">
            <div class="folder">

            </div>
            <div class="folderContent">

            </div>
        </div>
    </div>
</div>

<script>

</script>

<style>
    .storageContent{
        border:solid 2px red;
    }
    .action{
        background: gray;
    }
    .action>span{
        border:solid 2px blue;
        margin-left: 5px;
    }
    .storageContent_{
        flex-grow: 1;
        border:solid 1px green;
    }
    .storageContent_ .folder{
        border: solid 1px white;
        width:200px;
    }
    .storageContent_ .folderContent{
        flex-grow: 1;
        border: solid 1px black;
    }
</style>