<?php
    if (isset($_GET['removeUser'])) {
        echo $_GET['removeUser'];
        UserGroup::removeUserToSamba( $_GET['removeUser'] );
    }
?>