<?php
if(count($argv) < 3) {
  print "Usage : php task_2.php <fieldName> <value>".PHP_EOL;
  die();  }
$handle = fopen("users.csv", "r+");

$rowOne = fgetcsv($handle, 0, ",");
$rowTwo = fgetcsv($handle, 0, ",");
$value= $argv[2];
$fieldName = $argv[1];



while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
$result  = array_combine($rowOne,$data); 
 
    if (str_contains($result[$argv[1]],$value))
       print_r($result);
    }

?>