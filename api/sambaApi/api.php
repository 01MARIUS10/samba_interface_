<?php
// $currentPath = getcwd();

// echo $currentPath;

    // require_once('./api/sambaApi/User/userRepository.php');
    require_once('./User/userRepository.php');
    // $users = UserRepository::getAll();
    // echo $users;

    $p['name']="TOOTto";
    $p['passwd']='ioioioio';
    $p = UserRepository::createUser($p);
    echo $p;
?>