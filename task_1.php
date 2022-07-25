<?php
//[ "task_1.php", "user.csv", "Andrew" ] <= php task_1.php user.csv Andrew
  [ $script,      $filename,  $username] = $argv;

print "Searching $username in $filename".PHP_EOL;

// (filename, name) => user[]
function filter_by_name(string $filename, string $username): array
{
    $result = []; // [stringa, stringb, 1,2,3,]
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            if (str_contains($data[0], $username)) {
                $result[] = $data;
                // array_push($result, $data);
            }
        }
        fclose($handle);
    }

    return $result;
}

$results = filter_by_name($filename, $username);

print_r(array_map('json_encode', $results));

// A => A'
// [..] | [..]'