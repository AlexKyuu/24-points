<?php

require_once 'sort.php';

set_error_handler(function ($errno, $errstr) {
    //
}, E_WARNING);

$operations = ['+', '-', '*', '/'];

$possibleOperations = [
    "%d %s %d %s %d %s %d",   // 无括号
    "(%d %s %d) %s %d %s %d", // 一对括号
    "%d %s (%d %s %d) %s %d",
    "%d %s %d %s (%d %s %d)",
    "(%d %s %d %s %d) %s %d",
    "%d %s (%d %s %d %s %d)",
    "(%d %s %d) %s (%d %s %d)", // 两对括号
    "((%d %s %d) %s %d) %s %d",
    "(%d %s (%d %s %d)) %s %d",
    "%d %s ((%d %s %d) %s %d)",
    "%d %s (%d %s (%d %s %d))",
];

$file = "all-possibles.log";
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

    $toCal = explode(', ', $line);
    $numbersAll = sortAll($toCal[0], $toCal[1], $toCal[2], $toCal[3]);

    $count = 0;

    foreach ($numbersAll as $number) {

        $a = $number[0];
        $b = $number[1];
        $c = $number[2];
        $d = $number[3];

        foreach ($possibleOperations as $possibleOperation) {
            for ($o1 = 0; $o1 < 4; $o1++) {
                for ($o2 = 0; $o2 < 4; $o2++) {
                    for ($o3 = 0; $o3 < 4; $o3++) {
                        $expression = sprintf("$possibleOperation", $a, $operations[$o1], $b, $operations[$o2], $c, $operations[$o3], $d);
                        $value = eval("return intval(round($expression));");
                        if ($value == 24) {
                            $count++;
                            // printf("$possibleOperation = 24\n", $a, $operations[$o1], $b, $operations[$o2], $c, $operations[$o3], $d);
                            printf("%s,$expression,1\n", implode(',', $toCal));

                            // TODO: save to db
                        }
                    }
                }
            }
        }

    }

    if ($count == 0) {
        printf("%s,-,0\n", implode(',', $toCal));
    }
}

restore_error_handler();
