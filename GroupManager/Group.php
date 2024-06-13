<?php 
class Group {
    public function ajouterUser($user, $group) {
        exec("sudo gpasswd " . $user . " -a " . $group);
    }
};

$grp = new Group();
$resp = $grp->ajouterUser('misa2026', 'smbd');
echo($resp)
?>
