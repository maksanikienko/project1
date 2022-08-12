<?php

require __DIR__ . '/functions.php';

// array_shift вытаскивает первый элемент из массив
$scriptPath = array_shift($argv); // task_5.php 
$command = array_shift($argv); // add, update, read или delete

$otherArgs = $argv; // всё что не вытащили это оставшиеся аргументы

match ($command) {
    "add" => add_item($$otherArgs[0]),
    "update" => update_item($otherArgs[0], $argv[1]),
    "read" => read_item(),
    "delete" => delete_item($otherArgs[0]),
    "help" => print get_help(),

    default => print "Command '$command' is not available. ".
    "Use 'php ".basename(__FILE__)." help' command for more details" . PHP_EOL,
};

/* нам не надо нигде указывать закрывающие теги */