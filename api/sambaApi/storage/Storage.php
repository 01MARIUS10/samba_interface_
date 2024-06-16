<?php
class Storage
{
    public static function getAll()
    {
        $allStorage = [];
        $allStorage['files'] = [];
        $allStorage['folders'] = [];
        $userStorage = [];
        $groupStorage = [];

        $command = "ls -al `find /var/share -type d` | tail -n +2";
        $output = shell_exec($command);
        $lines = explode("\n", $output);

        foreach ($lines as $line) {
            $array = preg_split('/\s+/', $line);

            if (count($array) == 9) {
                // print_r($array);echo '<br>';
                $storagName = $array[8];
                $user = $array[2];
                $group = $array[3];
                $storage = (int)$array[4];
                $isFolder = $array[0][0]=='d' ? 1:0;

                //infomation for all user storage
                $userStorage[$user]['totalStorage'] += $storage;
                $userStorage[$user]['directoryCount'] += ($isFolder)? 1:0;
                $userStorage[$user]['filesCount'] += (!$isFolder)? 1:0;
                $userStorage[$user][($isFolder? '_folders':'_files')][] = $storagName;
                
                //infomation for all group storage
                $groupStorage[$group]['totalStorage'] += $storage;
                $groupStorage[$group]['directoryCount'] += 1;
                $groupStorage[$group][($isFolder? '_folders':'_files')][] =$storagName;
            }
        }


        $RESULT = [];
        $RESULT['users'] = $userStorage;
        $RESULT['groups'] = $groupStorage;
        $RESULT['files'] = $allStorage['files'];
        $RESULT['folders'] = $allStorage['folders'];

        return $RESULT;
    }
    public static function getStorageSize($name)
    {
       $all =  Storage::getAll();
       $res = $all['users'][$name]['totalStorage'];
       return $res ? $res : 0;
    }


}

Storage::getAll();
