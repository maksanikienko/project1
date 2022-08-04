<?php

$handle = fopen("users.csv", "r+");

$rowOne = fgetcsv($handle, 0, ",");
$rowTwo = fgetcsv($handle, 0, ",");
$value= 'Gladys';

while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
$result  = array_combine($rowOne,$data); 
 
    if (str_contains($result['firstName'],$value))
       print_r($result);
    }

?>