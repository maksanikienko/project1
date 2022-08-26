<?php

require __DIR__ . '/functions.php';

// array_shift вытаскивает первый элемент из массив
$scriptPath = array_shift($argv); // task_5.php 
$command = array_shift($argv); // add, update, read или delete

$otherArgs = $argv; // всё что не вытащили это оставшиеся аргументы
while ($command = readline("todo>")) {
    match ($command) {
        "add" => add_item(readline("content>")),
        "update" => update_item(readline("id>"),readline("content>")),
        "read" => read_items(),
        "delete" => delete_item(readline("id>")),
        "status" => set_status(readline("id>"), readline("status>")),
        "help" => print get_help(),

        default => print "Command '$command' is not available. " .
            "Use 'php " . basename(__FILE__) . " help' command for more details" . PHP_EOL,
    };
    print PHP_EOL;
    read_items();
}
// добавляет поле статуса - new/in progress/done
//ошибка текстом