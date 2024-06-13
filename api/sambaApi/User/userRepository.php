<?php

class UserRepository{
    public static  function getAll(){
        $command = "grep -E '^[^:][^]:[0-9]{4,}:.*' /etc/passwd | awk -F: '$3 >= 1000 {print}' | sed 's/$/ |||/'";
        $output = shell_exec($command);

        $userlines = explode("|||",$output);
        $USER = [];

        foreach($userlines as $key=>$user){
            $userline = explode(':',$user);

            // var_dump($userline);die('');

            $u['id'] = $key;
            $u['Nom'] = $userline[0];
            $u['UID'] = $userline[2];
            $u['Groups'] = shell_exec('groups '.$userline[0]);
            $u['repertoire'] = $userline[6];

            array_push($USER,$u);

        }

        return  json_encode($USER);
    }

}

?>