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

                    //infomation for all storage
                  
                    $allStorage['totalStorage'] += $storage;
                    $allStorage['directoryCount'] += 1;
                    



                    //sum user storage
                    $userStorage['totalStorage'] += $storage;
                    $userStorage['directoryCount'] += 1;

                    //infomation for each user storage
                    
                    $userStorage[$user]['totalStorage'] += $storage;
                    $userStorage[$user]['directoryCount'] += 1;

                    //infomation for all user storage
                    $userStorage[$user][$storagName]['totalStorage'] = $storage;
                    $userStorage[$user][$storagName]['directoryCount'] += 1;

                    //sum group storage
                  
                    $groupStorage['totalStorage'] += $storage;
                    $groupStorage['directoryCount'] += 1;
                    //infomation for each group storage

                    $groupStorage[$group]['totalStorage'] += $storage;
                    $groupStorage[$group]['directoryCount'] += 1;

                    //infomation for all group storage
                    $groupStorage[$group][$storagName]['totalStorage'] = $storage;
                    $groupStorage[$group][$storagName]['directoryCount'] += 1;
               
            }
        }
        echo "tout les stockage";
        echo "<br><br>";
        echo json_encode($allStorage,JSON_PRETTY_PRINT );
        echo "<br><br><br>";
        echo "les stockage pour chaque chaque utilisateur";
        echo "<br><br>";
        echo json_encode($userStorage,JSON_PRETTY_PRINT );
        echo "<br><br><br>";
        echo "les stockage pour chaque groupe";
        echo "<br><br>";
        echo json_encode($groupStorage,JSON_PRETTY_PRINT );
    }
}

Storage::getAll();
?>
