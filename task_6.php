<?php
require('functions.php');
match($argv[1]){
    "add" => add_item($argv[2]),
    "update" => update_item($argv[2], $argv[3]),
    "read" => read_item(),
    "delete" => delete_item($argv[2]),
 }

?>