<?php
class Storage
{
    public static function getAll()
    {

        $STORAGE = [];
        $command = "ls -al `find /var/share -type d` | tail +2 | awk -F '  ' '{print $1 $2 $3 $4 $5 $6 $7 $8}'";
        $command = "ls -al `find /var/share -type d` | tail +2 ";
        $output = shell_exec($command);
        $lines = explode("\n", $output);
        foreach ($lines as $line) {
            $array = preg_split('/\s+/', $line);
            if (count($array) == 9) {
                array_push($STORAGE, [
                    "name" => $array[8],
                    "storage" => $array[4]
                ]);

            }
            

            // $field=explode(' ',$line);
            // var_dump($field);
            // // var_dump($line[0]);
            //     settype($field[4], 'integer');
            //     // var_dump($field[4]);
            //     if($line[0]=="/" || $line[0]=="" || $line[0]=="t" || $line[0]=="l"){
            //         continue;
            //     }
            //     if($line[0]=="d"){
            //         echo"<pre> D: $field[8] : $field[4]</pre>";
            //     }
            //     if($line[0]=="d"){
            //         echo"<pre> F: $field[8] : $field[4]</pre>";
            //     }
        }
        echo json_encode($STORAGE);
    }

}
Storage::getAll();

?>