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
        // Déclaration pour stocker la valeur de retour
        $USERS = [];

        // Commande pour avoir tous les users dans le group donné
        $command = "getent group " .$groupName . " | cut -d: -f4 | tr ',' '\n'";

        // LA sortie de la commande lorsqu'elle est executé
        $output = shell_exec($command);

        // On split l'output pour avoirs les listes des users
        $USERS = explode(' ', $output);

        return $USERS;
    }

    public static function getGroupId($groupName) {
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
    

};

$GROUPS                 = UserGroup::getAllUser();
$USERS                  = UserGroup::getAllUserInGroup('sudo');
$ID_ROOT                = UserGroup::getGroupId('root');
$FOLDER_OWNED_BY_ROOT   = UserGroup::getAllFilesOwnedByGroup('misa2026', '.');

// echo "sudoers \n"; var_dump($GROUPS);
// echo $ID_ROOT;
// var_dump( $FOLDER_OWNED_BY_ROOT );
?>
