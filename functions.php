<?php
// это константа, что-то типа переменной, только которую нельзя никак изменить
// они доступны из любой точки приложения после того как ты их обьявил
// обычно они хранят пути к папкам, какие-то важные названия, значения и тд
const STORAGE_PATH = __DIR__ . "/storage.json";


function add_item(string $content)
{
    // мы должны вытащить путь к хранилищу в константу чтобы потом не бегать по всему коду
    // и менять его везде если файл должен будет быть переименован или у нас будет несколько файлов

    if (!file_exists(STORAGE_PATH)) {
        // $arr и $string нам на самом едел тут не нужны, мы их можем убрать
        file_put_contents(STORAGE_PATH, json_encode([]));
    }

    $file = file_get_contents(STORAGE_PATH);
    $data = json_decode($file);
    $data[] = ['id' => uniqid(""), 'content' => $content, 'timestump' => date("20-12-2000")];
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(STORAGE_PATH, $data);
};

// для редактирования нам нужно знать какую запись мы ищем ($id) и что мы хотим в ней поменять ($content)
function update_item(string $id, string $content)
{
    if (!file_exists(STORAGE_PATH)) {
        file_put_contents(STORAGE_PATH, json_encode([]));
    }

    $file = file_get_contents(STORAGE_PATH);
    $data = json_decode($file, true);

    $current = $id;
    foreach ($data as $key => $value) {

        if ($value['id'] === $current) {
            $data[$key]['content'] = $content;
        }
    }

    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(STORAGE_PATH, $data);
};

// удаление происходит по идентификатору ($id) записи
function delete_item(string $id)
{
    if (!file_exists(STORAGE_PATH)) {
        file_put_contents(STORAGE_PATH, json_encode([]));
    }

    $file = file_get_contents(STORAGE_PATH);
    $data = json_decode($file, true);

    foreach ($data as $key => $value) {
        if ($value['id'] === $$id) {
            unset($data[$key]);
        }
    }

    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(STORAGE_PATH, $data);
};

function read_items()
{
    if (!file_exists(STORAGE_PATH)) {
        file_put_contents(STORAGE_PATH, json_encode([]));
    }

    $file = file_get_contents(STORAGE_PATH);
    $data = json_decode($file);
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(STORAGE_PATH, $data);
    print_r($data);
};

function get_help()
{
    return
        "Usage:    php script.php <command> <...arguments>" . PHP_EOL .
        "Commands:" . PHP_EOL .
        "   read                  - display records from the storage"  . PHP_EOL .
        "   add    <content>      - add a records to the storage" . PHP_EOL .
        "   edit   <id> <content> - edit a records from the storage" . PHP_EOL .
        "   delete <id>           - delete a records from the storage" . PHP_EOL .
        "   help                  - display this message" . PHP_EOL;
}
