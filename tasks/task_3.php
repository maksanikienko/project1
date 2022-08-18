<?php
//1. Если фаил не существует то 
//1.1 создаю массив данных
//1.2 кодирую его в json формат
//1.3 записываю в json файл то что получил после кодикровки

if (!file_exists("./php-calls.json")) { 
        $arr = array();
        $string = json_encode($arr);
        file_put_contents("./php-calls.json",$string);
 }

//2  Извлекаю все данные из json файла
$file = file_get_contents("./php-calls.json");

//3. Раскодирую их в переменную 
$content = json_decode($file);


//4. Добавляю в полученную переменную свою запись
$content[]= ['id'=> uniqid(""), 'arguments'=>implode(" ", $argv),'timestump'=> date("20-12-2000")];

//5. Кодирую эту переменную в json формат. 
$content = json_encode($content, JSON_PRETTY_PRINT);


//6. Кладу результат кодировани в json файл.
file_put_contents("./php-calls.json",$content);
//print_r($content);
?>