<?php

use Manikienko\Todo\Application;
use Manikienko\Todo\Filesystem;
use Manikienko\Todo\Storage;

// ах да, забыл сказать - functions.php нам больше не нужен.
// Как ты мог заметить, почти все взаимодействия между файлами были автоматизированны,
// и ничего никуда не надо пока что подгружать

// скрипт который занимается автоподгрузкой классов
require "./vendor/autoload.php";

define('STORAGE_PATH', __DIR__ . '/storage.json');

$app = new Application(new Storage(new Filesystem(), STORAGE_PATH));

while ($command = readline("todo>")) {
    match ($command) {
        "add" => $app->addItem(readline("content>")),
        "update" => $app->updateItem(readline("id>"),readline("content>")),
        "read" => $app->readItems(),
        "delete" => $app->deleteItem(readline("id>")),
        "set-status" => $app->setItemStatus(readline("id>"), readline("status>")),
        "help" => print $app->getHelp(),
        "exit" => die("See you later".PHP_EOL),

        default => print "Command '$command' is not available. " .
            "Use 'php " . basename(__FILE__) . " help' command for more details" . PHP_EOL,
    };
    print PHP_EOL;
    $app->readItems();
}


// Что будем делать потом
// [ ] Ответим на твои вопросы
// [ ] Добавим Item
// [ ] Уменьшим количество операций с файлами (будут только при запуске приложния и его выключении)
// [ ] Избавимся от прямого использования readline, потому что он своего рода взаимодействия с файловой системой, а значит помещает тестированию