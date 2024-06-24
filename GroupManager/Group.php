<?php


/* **************************************************************** */

class UserGroup
{

    public static $RACINEPATH = "/home/marius/Documents/COURS/Mr_Haga/Interface_samba/samba_interface_/";

    private static function getAllUser()
    {
        // Déclaration pour stocker la valeur de retour
        $USERS = [];

        // Commande pour avoir tous les users
        $command = "cat /etc/passwd | cut -d: -f1";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users
        $user_list = explode("\n", $output);

        // On trie les users car il y a des users invalides
        foreach ($user_list as $user)
            if ($user !== "")
                $USERS[] = $user;

        return $USERS;
    }

    /* **************************************************************** */

    private static function getAllUserInGroup($groupName)
    {
        // Déclaration pour stocker la valeur de retour
        $USERS = [];

        // Commande pour avoir tous les users dans le group donné
        $command = "getent group " . $groupName . " | cut -d: -f4 | tr ',' '\n'";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users dans les groupes
        $USERS = explode(' ', $output);

        return $USERS;
    }

    /* **************************************************************** */

    private static function getGroupId($groupName)
    {
        $command = "awk -F: '/^" . $groupName . ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }

    /* ***************************************
// var_dump($users_);************************* */

    public static function getAllFilesOwnedByGroup($groupName, $pathFolder)
    {
        // Utilisation de escapeshellarg pour sécuriser la commande
        $safePathFolder = escapeshellarg($pathFolder);

        // Construction de la commande pour rechercher les fichiers appartenant au groupe spécifié
        $command = "find {$safePathFolder} -type f -group {$groupName}";

        // Exécution de la commande et capture de la sortie
        $output = shell_exec($command);

        // Retour de la sortie sous forme de tableau
        return explode("\n", $output);
    }

    /* **************************************************************** */

    public static function getAllGroups()
    {
        // COmmande
        $command = "getent group | cut -d: -f1,3";
        $RESULT = [];

        exec($command, $output);
        $ue = UserGroup::sambGrp();
        // var_dump($ue);die();
        foreach ($output as $p) {
            $e = explode(':', $p);
            if (isset($ue[$e[0]])) {
                $users = [trim(shell_exec("getent group " . trim($e[1]) . " | cut -d: -f4")), $e[0]];
                $users = array_filter($users);
                $RESULT[] = [
                    'Nom' => $e[0],
                    'GID' => $e[1],
                    "Path" => $ue[$e[0]]['path'],
                    "Users" => implode(" , ",$users),
                    "created_at" => "23-01-2023 a 12h15",
                    "storage" => 8
                ];
            }
        }

        return $RESULT;
    }

    public static function getGroupByName($name){
        // COmmande
        $command = "getent group | cut -d: -f1,3 | grep {$name}";
        $RESULT = [];

        exec($command, $output);
        $ue = UserGroup::sambGrp();
        // var_dump($ue);die();
        foreach ($output as $p) {
            $e = explode(':', $p);
            if (isset($ue[$e[0]])) {
                $users = [trim(shell_exec("getent group " . trim($e[1]) . " | cut -d: -f4")), $e[0]];
                $users = array_filter($users);
                $RESULT[] = [
                    'Nom' => $e[0],
                    'GID' => $e[1],
                    "Path" => $ue[$e[0]]['path'],
                    "Users" => implode(" , ",$users),
                    "created_at" => "23-01-2023 a 12h15",
                    "storage" => 8
                ];
            }
        }

        return $RESULT[0];
    }

    public static function extractGrp($tableau)
    {
        $grps = [];
        foreach ($tableau as $element) {
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            foreach ($element as $k => $e) {
                if($k=='group'){
                    $grps[$e]=$element;
                }
            }
        }
        // var_dump($grps);
        return $grps;
    }

    public static function sambGrp()
    {
        // $command = "grep -v '^;' /etc/samba/smb.conf | grep 'write list =' ";
        // $output = shell_exec($command);
        // $lines = (explode("\n", $output));

        $command = UserGroup::$RACINEPATH . "shell/group.sh";
        $output = shell_exec($command);
        // var_dump([$command,$output]);die();echo "<br>";

        $array = explode("\n", $output);
        $G = [];
        $tmpKey = 'default';
        foreach ($array as $g) {
            if ($g[0] == "[") {
                $tmpKey = $g;
            } else if ($g[0] == "P") {
                $G[$tmpKey]['path'] = trim(str_replace("Path:", '', $g));
            } else if ($g[0] == "G") {
                $G[$tmpKey]['group'] = trim(str_replace("Group:", '', $g));
            }

        // var_dump($g);echo "<br>";
        }

        // var_dump($G);echo "<br>";

        return UserGroup::extractGrp($G);

        // return UserGroup::extractGrp($lines);

    }

    /* **************************************************************** */

    public static function getAllGroupsDetails()
    {
        $GROUPS = UserGroup::getAllGroups();
        var_dump($GROUPS);
    }

    /* **************************************************************** */

    public static function getAllUserSamba()
    {
        // On enleve les espaces de trop
        // $command = "sudo pdbedit -Lv | sed -e 's/[[:blank:]]\{2,\}/ /g' | grep 'Unix' | cut -d' ' -f3";
        // On enleve le 


        $command = "sudo pdbedit -L | cut -d: -f1";
        $output  = shell_exec($command);
        $output = explode("\n", $output);
        $USERS_SAMBA = [];

        foreach ($output as $user)
            if ($user !== "")
                $USERS_SAMBA[] = $user;

        return $USERS_SAMBA;
    }

    /* **************************************************************** */

    public static function addUnixUserToSamba($username, $passwd)
    {
        $command = "printf '$passwd\n$passwd\n' | sudo smbpasswd -a {$username}";
        $output = shell_exec($command);
        if ($output === null) {
            return false;
        }
        else {
            return true;
        }
    }

    public static function updateGroup($user, $groupsAdd, $groupsRemove)
    {

    }

    public function isGroupExist($groupName){
        $command = "getent group $groupName";
        $output = shell_exec($command);
        if($output){
            return true;
        }
        return false;
    }

    

    /* **************************************************************** */

    public static function debug()
    {
        // $ALL_USERS                  = UserGroup::getAllUser();
        // $ALL_USERS_INSIDE_GROUP     = UserGroup::getAllUserInGroup('sudo');
        // $ID_ROOT                    = UserGroup::getGroupId('root');
        // $FOLDER_OWNED_BY_ROOT       = UserGroup::getAllFilesOwnedByGroup('misa2026', '/var/share');
        // $ALL_SAMBA_USERS            = UserGroup::getAllUserSamba();
        $ADDING_UNIX_USER_TO_SAMBA  = UserGroup::addUnixUserToSamba('toto', "toto");

        var_dump(
            // $ALL_SAMBA_USERS,
            // $ALL_USERS,
            UserGroup::getAllGroups()
            // $ADDING_UNIX_USER_TO_SAMBA
        );
    }

    /* **************************************************************** */

    public static function addUnixUserToGroupUnix($user, $group) {
        $command = "sudo gpasswd -a {$user} {$group}";
        shell_exec($command);
    }

    /* **************************************************************** */

    public static function createUnixGroup($group) {
        shell_exec("sudo groupadd {$group}");
    }
};

/* **************************************************************** */

// UserGroup::debug();

/* **************************************************************** */

// echo "sudoers \n"; var_dump($GROUPS);
// echo $ID_ROOT;
// var_dump( $FOLDER_OWNED_BY_ROOT );


/* **************************************************************** */
