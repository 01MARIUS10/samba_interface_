<div id="storageList" class="w-100 h-100 position-relative">
    <div class="storageContent d-flex flex-column w-100 h-100">
        <div class="action d-flex p-2 bluebg justify-content-between">
            <div class="breadCrumb d-flex"></div>
            <div class="d-flex btn-action">
                <span type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="New Folder">cree un dossier</span>
                <span onclick="document.querySelector('#newFile').click()">upload</span>
                <form id="newFormUpload">
                    <input type="file" name="newFile" id="newFile" hidden>
                    <input type="text" id="pathId" hidden>
                </form>
                <span
                onclick='updateView()'
                >refresh</span>
            </div>
        </div>
        <div class="storageContent_ d-flex">
            <!-- <div class="folder">

            </div> -->
            <div class="fcc h-100">
                <div class="folderContent h-100">
                    <div class="d-flex flex-column">
                        <img src="/images/icon/file.png" alt="">
                        <span>MyFile</span>
                    </div>
                    <div class="d-flex flex-column">
                        <img src="/images/icon/folder.png" alt="">
                        <span>MyFolder</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header px-3 py-2">
                    <h5 class="modal-title" id="exampleModalLabel">cree</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="newFolderId" onchange="(e)=>onchangeInput(e)">
                        </div>

                    </form>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss='modal' onclick="submitCreateFolder()">cree</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var  fileAndFolder = []
    // =======================================
    const inputImage = document.getElementById('newFile');

    inputImage.addEventListener('change', function() {
        uploadImage(inputImage.files[0]);
    });

    async function uploadImage(file) {
        let f = document.querySelector('#newFormUpload')
        const formData = new FormData(f);

        formData.append('path', path);

        console.log(formData)
        try {
            const response = await fetch(`http://localhost:8999/api/FileManager/__createFolder.php?path=${path}`, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            lsFolder(path)
            console.log(data);
            f.reset();
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    }


    // ===============================================
    let newFolder

    let newfolderNode = document.querySelector('#newFolderId')


    newfolderNode.addEventListener("change", (event) => {
        newFolder = `${event.target.value}`;
        console.log(event.target.value)
    });

    function submitCreateFolder() {
        console.log(newFolder)
        if (newFolder) {
            // fetch('URL_DU_SERVEUR', { // Remplacez 'URL_DU_SERVEUR' par l'URL réelle de votre serveur
            fetch(`http://localhost:8999/api/FileManager/__createFolder.php?path=${path}&newFolder=${newFolder}`)
                .then(response => response.json()) // Si le serveur répond avec JSON
                .then(data => {
                    console.log('Success:', data);
                    lsFolder(path)

                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

    }


    function lsFolder(path_) {
        path = path_
        console.log("path is", path)

        function updateViewFile(ff) {
            fileAndFolder = ff

            function updateBreadcrumb(){
                // content_.innerHTML = `<span class="w-100">${path}</span>`
                let getBreadcrumb = (p) =>{
                    let s = p.split('/')
                    let res = []
                    let tmp = ''
                    s.forEach((e,i)=>{
                        if(tmp=='/'){
                            tmp = tmp+e
                            
                        }
                        else{
                            tmp = tmp+'/'+e
                        }  
                        res.push({'name': !e?'/':e,'path':tmp})
                    })
                    return res
                }
                let b = getBreadcrumb(path)

                let content_ = document.querySelector('.breadCrumb')
                content_.innerHTML = ''
                let max = b.length
                b.forEach((e,i)=>{
                    let f = `onclick=lsFolder('${e.path}')`
                    content_.innerHTML+=`
                    <span onclick="${f}">${e.name}</span>
                    `
                    if(i<max-1){
                        content_.innerHTML+=`<img src="/images/sup.png" alt="||"/>`
                    }
                })
            }
            updateBreadcrumb()
            
            if(typeof executeChart === "function"){
                executeChart()
            }





            let pathis = document.querySelector('#pathId')
            pathis.value = path

            let content = document.querySelector('.folderContent')
            content.innerHTML = ""

            fileAndFolder.forEach(e => {
                let f = `onclick=lsFolder('${e.path}')`
                // let fe = `type="button" 
                // data-toggle="modal" data-target="#exampleModal" data-whatever="${e.name}"
                // `

                content.innerHTML = content.innerHTML +
                    `
                    <div class="d-flex flex-column" ${ e.is_folder? f:''}>
                        <img src="/images/icon/${e.is_folder? 'folder':'file'}.png" alt="">
                        <span>${e.name}</span>
                    </div>
                `
            })

        }

        fetch(`http://localhost:8999/api/FileManager/__getFromPath.php?path=${path}`)
            .then(e => e.json())
            .then(res => updateViewFile(res))
    }
    let path = '/var/share'
    // path = '/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_'
    lsFolder(path)
    let updateView = ()=>lsFolder(path)
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-title').text(recipient)
        modal.find('.modal-body input').val('')
    })
</script>



<script>
     fetch(`http://localhost:8999/api/sambaApi/storage/Storage.php`)
            .then(e => e.json())
            .then(res => console.log(res))
</script>

<style>
    .modal {
        position: absolute !important;
    }

    .storageContent {
        border: solid 2px black;
    }

    .action {
        /* background: gray; */
        height: 50px;
    }

    .action>span {
        background: whitesmoke;
        border-radius: 4px;
        padding: 2px 5px;
    }

    .action>span {
        margin-left: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .storageContent_ {
        flex-grow: 1;
        max-height: calc(100% - 50px);
    }

    .storageContent_ .folder {
        width: 200px;
        border-right: solid 2px black;
    }

    .storageContent_ .folderContent {
        /* border: solid 1px black; */
    }

    .folderContent img {
        height: 60px;
    }

    .folderContent>div {
        width: 110px;
        align-items: center;
    }

    .folderContent {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-content: flex-start;
        overflow: scroll;
        /* justify-content: space-around; */
        padding: 10px 20px;
    }

    .fcc {
        flex-grow: 1;

    }
</style>