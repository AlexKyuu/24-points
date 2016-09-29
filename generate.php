<?php

// generate pokers
$suits = ['S', 'C', 'H', 'D'];

$cards = [];
foreach ($suits as $suit) {
    for ($number = 1; $number <= 13; $number++) {
        $cards[] = [
            'suit' => $suit,
            'number' => $number
        ];
    }
}

// print_r($cards);

$handled = [];

$count = 0;
for ($n1 = 0; $n1 < 52; $n1++) {
    for ($n2 = 0; $n2 < 52; $n2++) {
        for ($n3 = 0; $n3 < 52; $n3++) {
            for ($n4 = 0; $n4 < 52; $n4++) {
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

                $arrange = [
                    $cards[$n1],
                    $cards[$n2],
                    $cards[$n3],
                    $cards[$n4]
                ];

                uasort($arrange, function ($a, $b) {
                    return ($a['number'] <= $b['number']) ? -1 : 1;
                });

                // print_r($arrange);
                // $count++;
                // if ($count > 5) {
                //     exit(1);
                // }

                $numberKeyArr = [];
                $numbersArr = [];
                $allKeyArr = [];
                foreach ($arrange as $a) {
                    $numbersArr[] = $numberKeyArr[] = $a['number'];
                    $allKeyArr[] = $a['suit'] . "_" . $a['number'];
                }

                $numberKey = implode('_', $numberKeyArr);
                if (isset($handled[$numberKey])) {
                    continue;
                }

                $handled[$numberKey] = 1;

                printf("%s\n", implode(', ', $numbersArr));
            }
        }
    }
}
