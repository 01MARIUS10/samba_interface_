<?php
    if(isset($_GET['newFolder']) && isset($_GET['path'])){
        $path = $_GET['path'];
        $newfolder = $_GET['newFolder'];
        $p = realpath($path)."/".$newfolder;
        $output = shell_exec("mkdir $p");
        echo json_encode($output);
    }
    else if(isset($_GET['rename']) && isset($_GET['name']) && isset($_GET['path'])){
        $path = $_GET['path'];
        $oldName = $_GET['rename'];
        $name = $_GET['name'];
        $p = realpath($path)."/".$oldName; 
        $p2 = realpath($path)."/".$name;
        $output = shell_exec("mv $p $p2");
        echo json_encode($output);
    }

    if(isset($_FILES) && $_FILES!= []) {
        $path= realpath($_GET['path']);
        // print_r([$_FILES['path'],$_GET]);
        // print_r([$path,$_GET['path']]);
        // die('ok');
        $extension = pathinfo($_FILES['newFile']['name'], PATHINFO_EXTENSION);
        $newName = $_FILES['newFile']['name'];
        $newName = implode("_", preg_split("/\s+/", $newName));

        // die();
        
        $bool =move_uploaded_file($_FILES['newFile']['tmp_name'], $path.'/'. $newName);
        
        $data = array(
            "return "=> $bool,
            'image_source' => $path.'/'. $newName
        );
        
        echo json_encode($data);
    }

?>