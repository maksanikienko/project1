<?php
//[ "task_1.php", "users.csv", "Andrew" ] <= php task_1.php user.csv Andrew
print_r($argv);
$script = $argv[0];
$filename = $argv[1];
$username = $argv[2];

 
print "Searching $username in $filename".PHP_EOL;

// (filename, name) => user[]
function filter_by_name(string $filename, string $username): array
{
    $result = []; // [stringa, stringb, 1,2,3,]
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            if (str_contains($data, $username)) {
                $result[] = $data;
                // array_push($result, $data);
            }
        }
        fclose($handle);
    }

    return $result;
}
//print_r($result);