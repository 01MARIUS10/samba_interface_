<?php

require_once "./userRepository.php";
    if(isset($_GET['newUser']) && isset($_GET['passwd'])){
        $params = [
            "name"=>$_GET['newUser'],
            "dir"=>$_GET['dir'],
            "group"=>isset($_GET['group'])? $_GET['group']:'',
            "passwd"=>$_GET['passwd'],
        ];
        print_r($params);
        UserRepository::createUnixUser($params);
        UserRepository::addUnixUserToSamba($params['name'],$params['passwd']);
        echo json_encode(['status'=>1]);
    }

    if(isset($_GET['newUSer']) && isset($_GET['passwd'])){
        echo $_GET['newUSer'], $_GET['passwd'] . '<br>';
        // UserRepository::updateUSer($_GET['updateUSer'],$_GET['passwd']);
    }
    
    // On efface l'utilisateur dans Samba si on reçoit un requete GET['removeUser']
    if (isset($_GET['removeUser'])) {
        echo $_GET['removeUser'];
        UserRepository::removeUserToSamba($_GET['removeUser']);
    }

    if(isset($_GET['deluser'])){
        $username = $_GET['deluser'];
        $command = "userdel -r $username";
        $output = shell_exec($command);
        echo json_encode($output);
    }
    if(isset($_GET['modifyUser'])){
        $user = $_GET['modifyUser'];
        if(isset($_GET['group'])){
            $grp = $_GET['group'];
            UserGroup::addUnixUserToGroupUnix($user, $grp);
        }
        echo json_encode(['status'=>1]);
    }
    if(isset($_GET['newGrp'])){
        $grp = $_GET['newGrp'];
        if(!UserGroup::isGroupExist($grp)){
            UserGroup::createUnixGroup($grp);
        }
        // AJout de l user dans le group unix et samba
        UserGroup::addUnixUserToGroupUnix($nom, $grp);
        
        
        // Création du dossier de partage
        $pathGroup = "/var/share/{$grp}";
        if(isset($_GET['pathGroup'])){
            $pathGroup = $_GET['pathGroup'];
        }
        
        $command = "sudo mkdir -p {$pathGroup}";
        shell_exec($command);

        // Configuration popur le partage samba
        $smbConf = "\n[{$nom}]\npath = {$pathGroup}\nwrite list = {$grp}\n";

        // AJout du text de configuration dan /etc/samba/smb.conf
        $command = "sudo echo '{$smbConf}' >> /etc/samba/smb.conf";
        shell_exec($command);
        $restartSmbComd = "sudo systemctl restart smbd";
        shell_exec($restartSmbComd);
        
        
        echo json_encode(['status'=>1]);
    }
    if(isset($_GET['modifyGroup'])){
        $group = $_GET['modifyGroup'];
        if(isset($_GET['path'])){
            $path = $_GET['path'];
            UserGroup::addUnixUserToGroupUnix($user, $grp);
        }
        $G = UserGroup::getGroupByName($group);
        // print_r($G);

        $command = "mv {$G['Path']} {$path}";
        $output = shell_exec($command);

        echo json_encode(['status'=>1,'command'=>$command]);
    }
    if (isset($_GET['removeGrp'])) {
        $grpName =  $_GET['removeGrp'];
        $command = "groupdel -f $grpName";
        $output = shell_exec($command);

        echo json_encode(['status'=>1,'command'=>$command]);
    }
    if(isset($_GET['test'])){
        $command = "cat /etc/samba/smb.conf";
        $output = shell_exec($command);
        var_dump($output);
        echo '<br><br>';
        $before =  " [test2] path = /var/share/test2";
        $after = " [test2] path = /var/share/test3";
        var_dump(str_replace($before,$after,$output));
        echo '<br><br>';
        var_dump($output);
    }
    

    

    
?>