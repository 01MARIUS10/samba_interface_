<?php
class Storage
{
    public static function getAll()
    {
        // $command = "ls -l `find /var/share -type d` | awk '{print \$1,\$2,\$3,\$4,\$5,\$6,\$7,\$8,\$9}'";
        $command ="ls -l `find /var/share -type d`";
        $output = shell_exec($command);
        
        $storage_list = preg_split("\n\n", $output);
        var_dump($storage_list);
        // foreach( $storage_list as $elem){
        //     echo "<pre>$elem</pre>";
        //     $command2 = " tail +3";
        //     $output2 = shell_exec($command2);
        //     echo "<pre>$output2</pre>";
        // }
       
        $STORAGE = [];

        foreach ($storage_list as $key => $storage){
            print_r('<br>-------------------------------------------<br>');
            if (empty($storage))
                continue;

            $storageline = explode(' ', $storage);
            settype($storageline[4], 'integer');
            global $u;
            $u = [
                'id' => $key,
                'Nom' => isset($storageline[8]) ? $storageline[8] : '',
                'droit' => isset($storageline[0]) ? $storageline[0] : '',
                'user' => isset($storageline[2]) ? $storageline[2] : '',
                'group' => isset($storageline[3]) ? $storageline[3] : '',
                'storage' => isset($storageline[4]) ? $storageline[4] : '',
                'date' => isset($storageline[5], $storageline[6], $storageline[7]) ? "$storageline[5] $storageline[6] $storageline[7]" : '',
                'is_folder' => (isset($u['droit']) && $u['droit'][0] == "d") ? true : false
            ];

            // var_dump($u['droit'][0]);
            // var_dump($u['is_folder']);
            // var_dump([
            //     isset($u['droit']),

            //     $u['droit'][0] == "d",

            //     isset($u['droit']) && $u['droit'][0] == "d",

            //     (isset($u['droit']) && $u['droit'][0] == "d") ? true : false,

            //     $u['is_folder']
            // ]);
            array_push($STORAGE, $u);
            foreach ($u as $element) {
                echo "<pre>$element</pre>";
            }
        }
    }
    // set value
    public static function setAll()
    {
        // Storage::getAll();  
        $i = "E";
        $command1 = "cd /var/share ; mkdir {$i} ; cd - ; ls -l /var/share";
        $output1 = shell_exec($command1);
        echo "<pre>$output1</pre>";
    }
}
Storage::getAll();

?>