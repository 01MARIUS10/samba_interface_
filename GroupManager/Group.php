<?php 
class UserGroup {
    public static function getAllUser() {
        $USERS = [];
        $command = "cat /etc/passwd | cut -d: -f1";
        $output = shell_exec($command);
        $user_list = explode("\n", $output); 
        
        foreach($user_list as $user )
            if($user !== "")
                $USERS[] = $user;

        return $USERS;
    }

    public static function getAllUserInGroup($groupName) {
        $USERS = [];

        $command = "getent group " .$groupName . " | cut -d: -f4 | tr ',' '\n'";
        $output = shell_exec($command);

        $USERS = explode(' ', $output);

        return $USERS;
    }

    public static function getGroupId($groupName) {
        $command = "awk -F: '/^". $groupName. ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }    

    public static function getAllFileOwnedBy($groupName, $pathFolder) {
        $output = exec('sh ../scriptBash/findFolderOwner.sh '.$groupName . $pathFolder);
    }
    

};

$GROUPS                 = UserGroup::getAllUser();
$USERS                  = UserGroup::getAllUserInGroup('sudo');
$ID_ROOT                = UserGroup::getGroupId('root');
$FOLDER_OWNED_BY_ROOT   = UserGroup::getAllFileOwnedBy('sudo', '~');

// echo "sudoers \n"; var_dump($GROUPS);
// echo $ID_ROOT;
echo $FOLDER_OWNED_BY_ROOT;
?>
