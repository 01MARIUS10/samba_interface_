<?php


/* **************************************************************** */

class UserGroup
{
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
        //  getent group misa2026 | cut -d: -f4 | tr ',' '\n'
        $command = "getent group " . $groupName . " | cut -d: -f4 | tr ',' '\n'";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users dans les groupes
        $USERS = explode('\n', $output);
        print_r($USERS);

        foreach($USERS as $key => $user) {
            if ($user === "\n") {
                $user = "";
            }
            else {
                $USERS [] = str_replace(["\n", "\n"],"", $user);
            }
        }
        return $USERS;
    }

    /* **************************************************************** */

    private static function getGroupId($groupName)
    {
        $command = "awk -F: '/^" . $groupName . ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }

    /* **************************************************************** */

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

    private static function getAllGroups()
    {
        // COmmande
        $command = "getent group | cut -d: -f1";

        exec($command, $output);

        return $output;
    }

    /* **************************************************************** */

    public static function getAllGroupsDetails()
    {
        $GROUPS = UserGroup::getAllGroups();
        // var_dump($GROUPS);
        $ALL_GROUPS_DETAILS = [];
        // ;die();

        foreach ( $GROUPS as $group ) {
            $GROUP_DETAILS = [];
            $GROUP_DETAILS['ID']    = UserGroup::getGroupId($group);
            $GROUP_DETAILS['NAME']  = $group;
            $GROUP_DETAILS['USERS'] = UserGroup::getAllUserInGroup($group);
            $ALL_GROUPS_DETAILS[]   = $GROUP_DETAILS;
            
        }
        print_r($ALL_GROUPS_DETAILS);die();

        return json_encode($ALL_GROUPS_DETAILS);
    }

    /* **************************************************************** */

    public static function getAllUserSamba()
    {
        // On enleve les espaces de trop
        $command = "sudo pdbedit -Lv | sed -e 's/[[:blank:]]\{2,\}/ /g' | grep 'Unix' | cut -d' ' -f3";
        // On enleve le 
        // $command = "sudo pdbedit -L | cut -d: -f1";
        $output  = shell_exec($command);
        $output = explode("\n", $output);
        $USERS_SAMBA = [];

        foreach( $output as $user ) {
            if ($user !== "") {
                $user = str_replace(['\n', '\r'], "", $user);
                $USERS_SAMBA[] = $user;
            }

        }

        return $USERS_SAMBA;
    }

    /* **************************************************************** */

    public static function addUnixUserToSamba($username, $passwd) {
        $command = "(echo {$passwd} ; echo {$passwd}) | sudo smbpasswd -as {$username} 1> /dev/null";
        shell_exec($command);
    }

    /* **************************************************************** */

    public static function removeUserSamba( $username ) {
        $command = "sudo pdbedit -x {$username}";
        shell_exec($command);
    }

    /* **************************************************************** */

    public static function debug()
    {        
        $ALL_USERS                  = UserGroup::getAllUser();
        $ALL_USERS_INSIDE_GROUP     = UserGroup::getAllUserInGroup('sudo');
        $ID_ROOT                    = UserGroup::getGroupId('root');
        $FOLDER_OWNED_BY_ROOT       = UserGroup::getAllFilesOwnedByGroup('misa2026', '/var/share');
        $ALL_SAMBA_USERS            = UserGroup::getAllUserSamba();
        $ADDING_UNIX_USER_TO_SAMBA  = UserGroup::addUnixUserToSamba('misa2026', "toavina");
        
        var_dump(
            // UserGroup::getAllUserInGroup("sudo")
            UserGroup::getAllGroupsDetails()
        );
    }
    
    /* **************************************************************** */


    /* **************************************************************** */
};

/* **************************************************************** */

UserGroup::debug();

/* **************************************************************** */

// echo "sudoers \n"; var_dump($GROUPS);
// echo $ID_ROOT;
// var_dump( $FOLDER_OWNED_BY_ROOT );


/* **************************************************************** */
