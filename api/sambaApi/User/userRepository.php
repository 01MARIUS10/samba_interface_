<?php
require_once('/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_/api/sambaApi/storage/Storage.php');
require_once('/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_/GroupManager/Group.php');

class UserRepository
{

    private static $RACINEPATH = "/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_/";

    private static function isIn($array,$key,$value){
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
        $command = "getent passwd | awk -F: '$3 >= 1000 && $3 < 65534' | grep -vE '^(root|bin|daemon|sys|sync|games|man|lp|mail|news|uucp|proxy|www-data|backup|list|irc|gnats|nobody|systemd|_apt|messagebus)$'";
        $output = shell_exec($command);

        $userlines = explode("\n", $output);
        foreach ($userlines as $key => $user) {
            $userline = explode(':', $user);
            
            
            if (count($userline) > 4 && in_array($userline[0],$SmbdUser) && !UserRepository::isIn($USER,'Nom',$userline[0])) {
    
                //format to the same array
                $u['id'] = count($USER)+1;
                $u['Nom'] = $userline[0];
                $u['UID'] = $userline[2];
                $allUserGrp = explode(' ',trim(str_replace("$userline[0] :","",shell_exec('groups ' . $userline[0]))));
                $grpNames = [];
                foreach(UserGroup::sambGrp() as $uSamba){
                    if(trim($uSamba['group']) !="" && in_array($uSamba['group'] ,$allUserGrp)){
                        array_push($grpNames,$uSamba['group']);
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
        return  ($USER);
    }

    public static function getSambaUser(){
        $command = "sudo pdbedit -L -v | grep '^Unix username:'"; 

        $output = shell_exec($command);
        $lines = (explode("\n",$output));

        return UserRepository::extractUser($lines);
    }

    private static function extractUser($tableau) {
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

    public static function getGroupId($groupName)
    {
        $command = "awk -F: '/^" . $groupName . ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
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

    public static function addUnixUserToSamba($user,$passwd){
        $command = UserRepository::$RACINEPATH."shell/createUser.exp $user $passwd";
        $output = shell_exec($command);
        return $output;
    }

    public static function removeUnixUserToSamba($user) {
        $command = "sudo pdbedit -x {$user}";
        shell_exec($command);
    }

    public static function ajouterUser($nom, $password, $group, $stockage) {
        // Création du group et de l user
        UserRepository::createUnixUser(['name'=>$nom]);
        UserGroup::createUnixGroup($group);

        // AJout de l user dans le group unix et samba
        UserGroup::addUnixUserToGroupUnix($nom, $group);
        UserGroup::addUnixUserToSamba($nom, $password);

        // Création du dossier de partage
        $command = "sudo mkdir -p /var/share/{$nom}";
        shell_exec($command);

        // Configuration popur le partage samba
        $smbConf = "\n[{$nom}]\npath = /var/share/{$nom}\nwrite list = {$group}\n";

        // AJout du text de configuration dan /etc/samba/smb.conf
        $command = "sudo echo '{$smbConf}' >> /etc/samba/smb.conf";
        shell_exec($command);
        $restartSmbComd = "sudo systemctl restart smbd";
        shell_exec($restartSmbComd);
    }

    public static function removeUserToSamba($user) {
        $commad = "sudo pdbedit -x -u {$user}";
        shell_exec($commad);
    }

    public function isUserExist($username){
        $command = "grep '^$username:' /etc/passwd";
        $output = shell_exec($command);
        if($output){
            return true;
        }
        return false;
    }


}
// 
UserRepository::getSambaUser();
