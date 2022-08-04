<?php
$num= 1;
$i = 0;
$handle = fopen("users.csv", "r");
$data = fgetcsv($handle, 0, ",");

foreach ($data as $key => $value) {
    
  if ($i % 1 === 0) {
        echo "{$key} => {$value} " . ' ';
    }
   $i++;
}

//$arr = explode(", ", $key);
//$arr2 = explode(", ", $value);
//$row1 = array_combine($arr, $arr2);
//print_r($data); 

fclose($handle)
?>