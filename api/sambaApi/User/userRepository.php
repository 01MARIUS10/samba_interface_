<?php

require_once('./api/sambaApi/storage/Storage.php');
require_once('./GroupManager/Group.php');

class UserRepository
{

    public static $RACINEPATH = "./";

    public static function isIn($array,$key,$value){
        foreach($array as $a){
            if($a[$key]==$value){return true;}
        }
        return false;
    }
    public static  function getAll()
    {
        $USER = [];
        $SmbdUser = UserRepository::getSambaUser();
        

        //get user in file /etc/passwd
        // $command = "grep -E '^[^:][^]:[0-9]{4,}:.*' /etc/passwd | awk -F: '$3 >= 1000 {print}'";
        $command = "grep -E '^[^:][^]:[0-9]{3,}:.*' /etc/passwd | awk -F: '$3 >= 1000 {print}'";
        $output = shell_exec($command);
        // print_r($output);

        $userlines = explode("\n", $output);
        foreach ($userlines as $key => $user) {
            $userline = explode(':', $user);
            // echo $userline[0];echo '<br>';
        // die();
            
            if (count($userline) > 4 && in_array($userline[0],$SmbdUser) && !UserRepository::isIn($USER,'Nom',$userline[0])) {
    
                //format to the same array
                // $u['id'] = $key;
                $u['id'] = count($USER)+1;
                $u['Nom'] = $userline[0];
                $u['UID'] = $userline[2];
                $allUserGrp = explode(' ',str_replace("$userline[0] :","",shell_exec('groups ' . $userline[0])));
                $grpNames = [];
                foreach(UserGroup::sambGrp() as $uSamba){
                    if(in_array($u['group'] ,$allUserGrp)){
                        array_push($grpNames,$uSamba["group"]);
                    }
                }
                $u['Groups'] = implode(' , ',$grpNames);
                $u['repertoire'] = $userline[6];
                $u['Usage'] = Storage::getStorageSize($userline[0]);
                $u['max-usage'] = 200000;
    
                //push new element in result
                array_push($USER, $u);
            }
        }
        // print_r($USER); echo '<br>';
        return  ($USER);
    }
    public static function extractUser($tableau) {
        $nomsUtilisateurs = [];
        foreach ($tableau as $element) {
            preg_match('/\s*:(.*)/', $element, $matches);
            // print_r([$element,$matches]);
            if (!empty($matches)) {
                $nomsUtilisateurs[] = trim($matches[1]);
            }
        }
        return $nomsUtilisateurs;
    }

    public static function getSambaUser(){
        $command = "sudo pdbedit -L -v | grep '^Unix username:'"; 

        $output = shell_exec($command);
        $lines = (explode("\n",$output));

        // print_r();
        // print_r($lines);

        return UserRepository::extractUser($lines);
    }
    public static function  createUnixUser($params)
    {
        if (!isset($params['name'])) return 0;

        $name = $params['name'];

        $dir  = (isset($params['dir'])  ?
            $params['dir'] :
            '/home/' . $params['name']
        );
        $group = (isset($params['group'])  ?
            ' -g' . $params['dir'] :
            ''
        );
        $password = (isset($params['passwd'])  ?
            '-p $(openssl passwd -1 ' . $params['passwd'] . ')' :
            ''
        );
        $command = "useradd -d $dir -s /bin/bash $group -m $password $name";
        // $output  = shell_exec('whoami');echo $output;
        $output  = shell_exec($command);

        return $output;
    }
    public static function getGroupId($groupName)
    {
        $command = "awk -F: '/^" . $groupName . ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }

    public static function addUnixUserToSamba($user,$passwd){
        $command = UserRepository::$RACINEPATH."shell/createUser.exp $user $passwd";
        $output = shell_exec($command);
        return $output;
    }

    public static function removeUnixUserToSamba($user) {
        $command = "sudo pdbedit -x {$user}";
        shell_exec($command);
    }
}

UserRepository::getSambaUser();
