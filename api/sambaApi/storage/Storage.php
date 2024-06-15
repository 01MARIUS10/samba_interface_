<?php
class Storage
{
    public static function getAll()
    {
        $allStorage= [];
        $userStorage = []; 
        $groupStorage=[];
        $command = "ls -al `find /var/share -type d` | tail -n +2";  
        $output = shell_exec($command); 
        $lines = explode("\n", $output);  

        foreach ($lines as $line) {
            $array = preg_split('/\s+/', $line);  
            if (count($array) == 9) {  
                $storagName=$array[8];
                $user = $array[2];  
               //  var_dump($user);
                $group=$array[3];
                $storage = (int)$array[4];  

                
                if (isset($userStorage[$user]) || isset($groupStorage[$group]) || isset($allStorage[$storagName])) {
                    $allStorage[$storagName]=$storage;
                    $userStorage[$user] += $storage;
                    $groupStorage[$group] += $storage;
                  //   var_dump($userStorage[$user]);
                } else {
                  $groupStorage[$group] = $storage;
                }
            }
        }
        echo "tout les stockage";
        echo "<br><br>";
        echo json_encode($allStorage);
        echo "<br><br><br>";
        echo "les stockage pour chaque chaque utilisateur";
        echo "<br><br>";
        echo json_encode($userStorage);
        echo "<br><br><br>";
        echo "les stockage pour chaque groupe";
        echo "<br><br>";
        echo json_encode($groupStorage);
    }
}

Storage::getAll();
?>
