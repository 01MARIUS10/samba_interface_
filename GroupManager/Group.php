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
};

$GROUPS = UserGroup::getAll();
var_dump($GROUPS);
?>
