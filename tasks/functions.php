<?php
// это константа, что-то типа переменной, только которую нельзя никак изменить
// они доступны из любой точки приложения после того как ты их обьявил
// обычно они хранят пути к папкам, какие-то важные названия, значения и тд
//const STORAGE_PATH = __DIR__ . "/data.json";
define('STORAGE_PATH', $argv[1] ?? __DIR__ . '/storage.json');

// мы должны вытащить путь к хранилищу в константу чтобы потом не бегать по всему коду
// и менять его везде если файл должен будет быть переименован или у нас будет несколько файлов


function add_item(string $content)
{
    $data = get_data_from_json_storage(STORAGE_PATH);

    $newItem = ['id' => uniqid(""), 'content' => $content, 'timestamp' => time()];
    $data[] = $newItem;

    // если вспомнить сценарии, то у нас во всех сценариях повторялись операции получить из файла и декодировать, и записать в файл закодировав
    // повторяющиеся операции являются функциями, которые ты хочешь переиспользовать, а значит их надо отдельно объявить
    save_data_to_storage(STORAGE_PATH, $data);

    print "New items with ID '{$newItem['id']}' was added." . PHP_EOL;
};


// для редактирования нам нужно знать какую запись мы ищем ($id) и что мы хотим в ней поменять ($content)
function update_item(string $id, string $newContent)
{
    $data = get_data_from_json_storage(STORAGE_PATH);

    foreach ($data as $key => $value) {

        if ($value['id'] === $id) {
            $data[$key]['content'] = $newContent;
            print "Item with ID '$id' was updated." . PHP_EOL;
        }
    }

    save_data_to_storage(STORAGE_PATH, $data);
};

// удаление происходит по идентификатору ($id) записи
function delete_item(string $id)
{
    $data = get_data_from_json_storage(STORAGE_PATH);

    foreach ($data as $key => $value) {
        if ($value['id'] === $id) {
            unset($data[$key]);
            print "Item with ID '$id' was deleted." . PHP_EOL;
        }
    }

    save_data_to_storage(STORAGE_PATH, $data);
};

function read_items()
{
    $records = get_data_from_json_storage(STORAGE_PATH);

    // нам не нужно тут ничего обратно сохранять, мы же только читаем

    // print_r это как бы норм вариант для разработчика, но ты всегда должен ориентироваться на обычного человека,
    // который не умеет читать вывод этой функции
    if (empty($records)) {
        print "No records found." . PHP_EOL;
    }

    foreach ($records as $record) {
        // date(<format:string>, <timestamp:int>) - это функция только форматирует даты которые передаются вторым аргументом,
        // но если ничего не передать, то это будет текущая дата
        $formattedDate = date('Y/m/d', $record['timestamp']);
        print "[{$record['id']}] {$record['content']} ($formattedDate)" . PHP_EOL;
    }
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

function get_data_from_json_storage(string $path)
{
    if (!file_exists($path)) {
        // $arr и $string нам на самом едел тут не нужны, мы их можем убрать
        file_put_contents($path, json_encode([]));
    }

    return json_decode(file_get_contents($path), true);
}

function save_data_to_storage(string $path, array $data): void {
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(STORAGE_PATH, $data);
}

