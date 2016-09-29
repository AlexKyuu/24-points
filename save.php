<?php

$host     = "127.0.0.1";
$dbname   = "laravel_test";
$username = "root";
$password = "for8.rod";

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

$file = "cal24-out.log";
$f = fopen($file, "r");
if (!$f) {
    print("file open error: $file\n");
    exit(1);
}

while (($line = fgets($f)) != false) {
    $line = trim($line);
    if (empty($line)) {
        continue;
    }

    list(
        $number_1,
        $number_2,
        $number_3,
        $number_4,
        $expression,
        $has_solution
    ) = explode(',', $line);

    $sql = "INSERT INTO `calculate_24points` (`number_1`, `number_2`, `number_3`, `number_4`, `expression`, `has_solution`) VALUES({$number_1}, {$number_2}, {$number_3}, {$number_4}, '{$expression}', {$has_solution});";

    $pdo->query($sql);
}


