<?php
    $result = [];
    $resultFile=[];

    function formatLsLine($currentPath , $line){
        try {
            $path = $currentPath."/".$line[7];
            $permission = "$line[0]";
            $user = "$line[2]";
            $group = "$line[3]";
            $size = "$line[4]";
            $name = "$line[7]";
            $created_at = "$line[5] $line[6]";
    
            
            return [
                "path"=>realpath($path),
                "size"=>$size,
                "permission"=>$permission,
                "user"=>$user,
                "group"=>$group,
                "created_at"=>$created_at,
                "name"=>$name,
                "is_folder"=>$permission[0]=="d"? 1:0
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    if(isset($_GET['path'])){
        $path = $_GET['path'];
        $path = realpath($path);
        $output = shell_exec("ls -al --time-style='+%d-%m-%Y %H:%M' $path ");
        $lines = explode("\n",$output);

       


        foreach($lines as $key =>$line){
            if($key==0){
                // print_r($line);
                // $result[0]=[
                // ];

            }
            else if($line != ""){
                // print_r($line);
                $a = formatLsLine($path,preg_split('/\s+/', $line));
                if($a['is_folder']) { array_push($result , $a);}
                else{array_push($resultFile,$a);}
                
                
                // print_r();
                // print_r(preg_split('/\s+/', $line));
            }
        }
    };
    array_push($result,...$resultFile);
    echo json_encode($result);
?>