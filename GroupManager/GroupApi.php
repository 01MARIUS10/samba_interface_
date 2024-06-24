<?php
require_once('../api/sambaApi/User/userRepository.php');
require_once('./Group.php');
    if (isset($_GET['removeUser'])) {
        echo $_GET['removeUser'];
        UserRepository::removeUserToSamba( $_GET['removeUser'] );
    }
    var_dump(UserGroup::isGroupExist('ketakas'));
?>