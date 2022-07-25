<?php
$row = 1;
//[ "task_1.php", "user.csv", "Andrew" ] <= php task_1.php user.csv Andrew
  [ $script,      $filename,  $username] = $argv;

print "Searching $username in $filename".PHP_EOL;

if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        if (str_contains($data[0], $username)) {
            echo "$row : " . json_encode($data) . PHP_EOL . "\n";
        }
        $row++;
    }
    fclose($handle);
}

// A => A'
// [..] | [..]'