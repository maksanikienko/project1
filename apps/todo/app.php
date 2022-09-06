<?php

use Manikienko\Todo\Application;
use Manikienko\Todo\Filesystem;
use Manikienko\Todo\Storage;

// скрипт который занимается автоподгрузкой классов
require "./vendor/autoload.php";

$app = new Application(
    new Storage(
        new Filesystem(),
        __DIR__ . '/storage/items.json'
    )
);

$app->run();

// Что будем делать потом
// [ ] Ответим на твои вопросы
// [ ] Добавим Item
// [ ] Уменьшим количество операций с файлами (будут только при запуске приложния и его выключении)
// [ ] Избавимся от прямого использования readline, потому что он своего рода взаимодействия с файловой системой, а значит помещает тестированию