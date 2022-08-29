<?php


// это константа, что-то типа переменной, только которую нельзя никак изменить
// они доступны из любой точки приложения после того как ты их обьявил
// обычно они хранят пути к папкам, какие-то важные названия, значения и тд
//const STORAGE_PATH = __DIR__ . "/data.json";

use Manikienko\Todo\Filesystem;
use Manikienko\Todo\Storage;


function get_data_from_json_storage(string $path)
{
    $storage = new Storage(new Filesystem(), STORAGE_PATH);

    return $storage->getItems($path);
}

function save_data_to_storage(string $path, array $data): void {
    $storage = new Storage(new Filesystem(), STORAGE_PATH);

    $storage->saveItems($data);
}