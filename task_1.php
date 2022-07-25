<?php
$row = 1;
$num = 1;
if (($handle = fopen("users.csv", "r")) !== FALSE) 
{
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) 
    
     
    {
        echo "<p> $num  $row: </p>\n";
        
         {
            print json_encode($data).PHP_EOL. "\n";
        }
    }
    fclose($handle);
}

?>