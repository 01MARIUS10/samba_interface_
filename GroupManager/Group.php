<?php 
class UserGroup {
    public static function getAll() {
        $GROUPS = [];
        $command = "cat /etc/passwd | cut -d: -f1";
        $output = shell_exec($command);
        $group_list = explode("\n", $output); 
        
        foreach($group_list as $group )
            if($group !== "")
                $GROUPS[] = $group;

        return $GROUPS;
    }

    public static function getAllUser($groupName) {
        $USERS = [];

        $command = "getent group " .$groupName . " | cut -d: -f4 | tr ',' '\n'";
        $output = shell_exec($command);

        $USERS = explode(' ', $output);

        return $USERS;
    }
};

$GROUPS = UserGroup::getAll();
$USERS = UserGroup::getAllUser('sudo');
var_dump($USERS);
?>
