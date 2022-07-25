<?php
$row = 1;
$num = 1;
if (($handle = fopen("users.csv", "r")) !== FALSE) 
{
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) 
    while (($last_name = current($data)) != false){
        if ($last_name == 'Cletus') {
            echo key($data), "\n";
        }
        next($data);
    }
     
    {
        echo "<p> $num  $row: </p>\n";
        
         {
            print json_encode($data).PHP_EOL. "\n";
        }
    }
    fclose($handle);
}

?>