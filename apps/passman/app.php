<?php

// [x] create - add password
// [x] update - update passwords
// [x] delete - delete passwords
// [x] read - delete passwords
// [ ] help

// [ ] protect all data with a masterpassword

// [ ] copy password to clipboard (optional)

define('STORAGE_PATH', __DIR__ . '/storage/passwords.json');

function get_data_from_storage(string $path): array
{
    if (!file_exists($path)) {
        save_data_to_storage($path, []);

        return [];
    }

    $json = file_get_contents($path);
    $data = json_decode($json, true);

    return $data;
}

function save_data_to_storage(string $path, array $data)
{
    file_put_contents($path, json_encode($data));
}

function add_password(string $label, string $password)
{
    $passwords = get_data_from_storage(STORAGE_PATH);
    if (isset($passwords[$label])) {
        print "Password label is already taken. Please use another one." . PHP_EOL;
        return;
    }

    $passwords[$label] = [
        'password' => $password,
        'timestamp' => time()
    ];

    save_data_to_storage(STORAGE_PATH, $passwords);

    print "Password for $label was saved." . PHP_EOL;
}

function update_password(string $label, string $newPassword)
{
    $passwords = get_data_from_storage(STORAGE_PATH);
    if (!isset($passwords[$label])) {
        print "Password with label '$label' does not exist." . PHP_EOL;
        return;
    }

    $passwords[$label] = [
        'password' => $newPassword,
        'timestamp' => time()
    ];

    save_data_to_storage(STORAGE_PATH, $passwords);

    print "Password for $label was updated." . PHP_EOL;
}
function delete_password(string $label)
{

    $passwords = get_data_from_storage(STORAGE_PATH);
    if (!isset($passwords[$label])) {
        print "Password with label '$label' does not exist." . PHP_EOL;
        return;
    }

    unset($passwords[$label]);

    save_data_to_storage(STORAGE_PATH, $passwords);

    print "Password for $label was deleted." . PHP_EOL;
}

function read_passwords()
{
    $passwords = get_data_from_storage(STORAGE_PATH);
    print "Passwords:" . PHP_EOL;
    // @fixme if empty show message
    foreach ($passwords as $label => $entry) {
        print " - $label:{$entry['password']} at {$entry['timestamp']}" . PHP_EOL;
    }
}

function get_help()
{
    // @todo add help
}

$script = array_shift($argv);
$command = array_shift($argv);

// @todo make interactive
match ($command) {
    "add" => add_password(readline('label> '), readline('password> ')),
    "update" => update_password(readline('label> '), readline('password> ')),
    "delete" => delete_password(readline('label> ')),
    "read" => read_passwords(),
    "help" => get_help(),
    default => "There is no command named '$command'"
};
