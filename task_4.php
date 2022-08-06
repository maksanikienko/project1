<?php
if(count($argv) < 2) {
    print "Usage : php task_2.php <id>".PHP_EOL;
    die();  }

if (!file_exists("./php-calls.json")) { 
        $arr = array();
        $string = json_encode($arr);
        file_put_contents("./php-calls.json",$string);
 }

$file = file_get_contents("./php-calls.json");

$content = json_decode($file, true);
$current = $argv[1];
foreach ( $content as $key => $value){        // Найти в массиве  

   if ($value['id'] === $current) {           // Переменную $current

    unset($content[$key]);             // после обнаружения удалить
   }
 } 
//$content[] = ['id'=> uniqid(""), 'arguments'=>implode(" ", $argv),'timestump'=> date("20-12-2000")];

$content = json_encode($content, JSON_PRETTY_PRINT);

file_put_contents("./php-calls.json",$content);
 
