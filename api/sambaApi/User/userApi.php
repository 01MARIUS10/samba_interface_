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

    // if(isset($_GET['updateUSer']) && isset($_GET['passwd'])){
    //     UserRepository::updateUSer($_GET['updateUSer'],$_GET['passwd']);
    // }



?>