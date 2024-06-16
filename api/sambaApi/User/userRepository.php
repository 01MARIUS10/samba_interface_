<?php

class UserRepository{
    public static  function getAll(){
        $USER = [];

        //get user in file /etc/passwd
        $command = "grep -E '^[^:][^]:[0-9]{4,}:.*' /etc/passwd | awk -F: '$3 >= 1000 {print}' | sed 's/$/ |||/'";
        $output = shell_exec($command);


        $userlines = explode("|||",$output);
        foreach($userlines as $key=>$user){
            $userline = explode(':',$user);

            //format to the same array
            $u['id'] = $key;
            $u['Nom'] = $userline[0];
            $u['UID'] = $userline[2];
            $u['Groups'] = shell_exec('groups '.$userline[0]);
            $u['repertoire'] = $userline[6];

            //push new element in result
            array_push($USER,$u);

        }

        return  json_encode($USER);
    }
    public static function  createUser($params){
        if(!isset($params['name'])) return 0;

        $name = $params['name'];

        $dir  = (isset($params['dir'])  ?
                $params['dir']:
                '/home/'.$params['name']
            );
        $group = (isset($params['group'])  ?
            ' -g'. $params['dir']:
            ''
        );
        $password = (isset($params['passwd'])  ?
            '-p $(openssl passwd -1 '.$params['passwd'].')':
            ''
        );
        $command = "useradd -d $dir -s /bin/bash $group -m $password $name";
        // $output  = shell_exec('whoami');echo $output;
        $output  = shell_exec($command);

        return $output;
    }
    public static function getGroupId($groupName) {
        $command = "awk -F: '/^". $groupName. ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }
}

?>