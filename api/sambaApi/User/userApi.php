<?php

require_once "./userRepository.php";
    if(isset($_GET['newUser']) && isset($_GET['passwd'])){
        $params = [
            "name"=>$_GET['newUser'],
            "dir"=>$_GET['dir'],
            "group"=>$_GET['group'],
            "passwd"=>$_GET['passwd'],
        ];
        UserRepository::createUnixUser($params);
        UserRepository::addUnixUserToSamba($params['name'],$params['passwd']);
        echo json_encode(['status'=>1]);
    }

    if(isset($_GET['newUSer']) && isset($_GET['passwd'])){
        echo $_GET['newUSer'], $_GET['passwd'] . '<br>';
        // UserRepository::updateUSer($_GET['updateUSer'],$_GET['passwd']);
    }
    
    // On efface l'utilisateur dans Samba si on reçoit un requete GET['removeUser']
    if (isset($_GET['removeUser'])) {
        echo $_GET['removeUser'];
        UserGroup::removeUserToSamba($_GET['removeUser']);
    }

    
?>