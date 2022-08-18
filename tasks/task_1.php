<?php

$handle = fopen("users.csv", "r+");

$rowOne = fgetcsv($handle, 0, ",");
$rowTwo = fgetcsv($handle, 0, ",");
$value= $argv[1];

while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
$result  = array_combine($rowOne,$data); 
 
    if (str_contains($result['firstName'],$value))
       print_r($result);
    }

?>