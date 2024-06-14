<?php 


/* **************************************************************** */

class UserGroup {
    private static function getAllUser() {
        // Déclaration pour stocker la valeur de retour
        $USERS = [];

        // Commande pour avoir tous les users
        $command = "cat /etc/passwd | cut -d: -f1";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users
        $user_list = explode("\n", $output); 
        
        // On trie les users car il y a des users invalides
        foreach($user_list as $user )
            if($user !== "")
                $USERS[] = $user;

        return $USERS;
    }

    /* **************************************************************** */

    private static function getAllUserInGroup($groupName) {
        // Déclaration pour stocker la valeur de retour
        $USERS = [];

        // Commande pour avoir tous les users dans le group donné
        $command = "getent group " .$groupName . " | cut -d: -f4 | tr ',' '\n'";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users dans les groupes
        $USERS = explode(' ', $output);

        return $USERS;
    }

    /* **************************************************************** */

    private static function getGroupId($groupName) {
        $command = "awk -F: '/^". $groupName. ":/ {print $3}' /etc/group";
        $output = exec($command);

        return $output;
    }    

    /* **************************************************************** */

    public static function getAllFilesOwnedByGroup($groupName, $pathFolder) {
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

    private static function getAllGroups() {
        // LA variable qui va contenir tous ls groups
        $GROUPS = [];
        
        // COmmande
        $command = "getent group | cut -d: -f1";
        
        exec($command, $output);

        return $output;
    }
    
    /* **************************************************************** */
    public static function getAllGroupsDetails() {

    }

    /* **************************************************************** */

    public static function debug() {
        $ALL_USERS                  = UserGroup::getAllUser();
        $ALL_USERS_INSIDE_GROUP     = UserGroup::getAllUserInGroup('sudo');
        $ID_ROOT                    = UserGroup::getGroupId('root');
        $FOLDER_OWNED_BY_ROOT       = UserGroup::getAllFilesOwnedByGroup('misa2026', '/var/share');
        UserGroup::getAllGroups();
    }

    /* **************************************************************** */

};

/* **************************************************************** */

UserGroup::debug();

/* **************************************************************** */

// echo "sudoers \n"; var_dump($GROUPS);
// echo $ID_ROOT;
// var_dump( $FOLDER_OWNED_BY_ROOT );


/* **************************************************************** */

?>