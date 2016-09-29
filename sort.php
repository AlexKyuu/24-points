<?php

$numbers = [1, 2, 3, 4];

// $unique = count(array_unique($numbers));
// if ($unique == 4) {
//     // 0 个相同
// } else if ($unique == 3) {
//     // 2 个相同
// } else if ($unique == 2) {
//     // 3 个相同
// } else if ($unique == 1) {
//     // 1 个相同
// } else {
//     //
//     exit(1);
// }

function sortAll($number1, $number2, $number3, $number4)
{
    $result = [];

    $numbers = [$number1, $number2, $number3, $number4];
    sort($numbers);
    $count = 0;
    for ($n1 = 0; $n1 < 4; $n1++) {
        for ($n2 = 0; $n2 < 4; $n2++) {
            for ($n3 = 0; $n3 < 4; $n3++) {
                for ($n4 = 0; $n4 < 4; $n4++) {
                    if (
                        $n1 == $n2
                        || $n1 == $n3
                        || $n1 == $n4
                        || $n2 == $n3
                        || $n2 == $n4
                        || $n3 == $n4
                    ) {
                        continue;
                    }

                    $result[] = [$numbers[$n1], $numbers[$n2], $numbers[$n3], $numbers[$n4]];
                }
            }
        }
    }

    return $result;
}

// $r = sortAll(1, 2, 3, 4);
// print_r($r);
