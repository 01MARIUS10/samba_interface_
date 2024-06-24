<?php
    require('api/sambaApi/User/userRepository.php');
    $userName = "rojo";
    $password = "azertyuiop";
    $group = "TestGroup";
    $stockage = 1000;
    print_r([
        $userName,
        $password,
        $group,
        $stockage
    ]);

    UserRepository::ajouterUser($userName, $password, $group, $stockage);
?>