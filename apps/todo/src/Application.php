<?php

namespace Manikienko\Todo;

class Application
{
    public function __construct(
        protected Storage $storage
    ) {
    }

    function addItem(string $content)
    {
        $data = $this->storage->getItems();

        $newItem = ['id' => uniqid(""), 'content' => $content, 'timestamp' => time()];
        $data[] = $newItem;

        // если вспомнить сценарии, то у нас во всех сценариях повторялись операции получить из файла и декодировать, и записать в файл закодировав
        // повторяющиеся операции являются функциями, которые ты хочешь переиспользовать, а значит их надо отдельно объявить
        $this->storage->saveItems($data);

        print "New items with ID '{$newItem['id']}' was added." . PHP_EOL;
    }


    // для редактирования нам нужно знать какую запись мы ищем ($id) и что мы хотим в ней поменять ($content)
    function updateItem(string $id, string $newContent)
    {
        $data = $this->storage->getItems();

        foreach ($data as $key => $value) {

            if ($value['id'] === $id) {
                $data[$key]['content'] = $newContent;
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($data);
    }

    //status
    const AVAILABLE_STATUSES = ['new', 'in-progress', 'done'];
    function setItemStatus(string $id, string $newStatus)
    {
        if (!in_array($newStatus, self::AVAILABLE_STATUSES)) {
            print "Status '$newStatus' cannot be used. Use please one of these:" . implode(", ", self::AVAILABLE_STATUSES);
            return;
        };
        $data = $this->storage->getItems();

        foreach ($data as $key => $value) {
            if ($value['id'] === $id) {
                $data[$key]['status'] = $newStatus;
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($data);
    }

    // удаление происходит по идентификатору ($id) записи
    function deleteItem(string $id)
    {
        $data = $this->storage->getItems();

        foreach ($data as $key => $value) {
            if ($value['id'] === $id) {
                unset($data[$key]);
                print "Item with ID '$id' was deleted." . PHP_EOL;
            }
        }

        $this->storage->saveItems($data);
    }

    function readItems()
    {
        $records = $this->storage->getItems();

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
            $status = $record['status'] ?? 'new';
            print "[{$record['id']}] <{$status}> {$record['content']} ($formattedDate)" . PHP_EOL;
        }
    }

    function getHelp()
    {
        return
            "Usage:    php script.php <command> <...arguments>" . PHP_EOL .
            "Commands:" . PHP_EOL .
            "   read                       - display records from the storage"  . PHP_EOL .
            "   add         <content>      - add a records to the storage" . PHP_EOL .
            "   edit        <id> <content> - edit a records from the storage" . PHP_EOL .
            "   set-status  <id> <content> - edit a records from the storage" . PHP_EOL .
            "   delete      <id>           - delete a records from the storage" . PHP_EOL .
            "   help                       - display this message" . PHP_EOL .
            "   exit                       - to exit the application" . PHP_EOL;
    }
}
