<?php
    require('api/sambaApi/User/userRepository.php');
    $userName = "test";
    $password = "azertyuiop";
    $group = "TestGroup";
    $stockage = 1000;

    UserRepository::ajouterUser($userName, $password, $group, $stockage);
?>