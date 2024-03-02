<?php
// Integer
$integer = 1;
// String
$string = "1";
// Bool
$bool = false;
// Null
$null = null;
// Float
$float = 0.34573454734585;
//$object = new std();
//$resource = new resource;

// Array
$array = [
    'kulcs1' => 'szöveg1',
    'kulcs2' => 'szöveg2',
    'kulcs3' => [
        'kulcs3' => 'szöveg3',
        'kulcs4' => 'szöveg4',
    ]
];
$array2 = [
    'kulcs3' => 'szöveg3',
    'kulcs4' => 'szöveg4',
];

// Null
$test = null;
// Bool
$variable = true;

// Ez itt a macska magasságát jelöli
$catHeight = 5;

// Szöveg "összeadás, összeolvasztás"
$string22 = "valami " . $string . " szöveg";
$string2 = "valami {$string} szöveg";
$string2222 = "valami' {$string} 'szöveg";
$string2222 = 'valami\' {$string} \'szöveg';

echo "<pre>";
// A var_dump() függvény kiírja a változók típusát is
//var_dump($array + $array2);
//var_dump(array_merge($array, $array2));
//var_dump(1 <> 1);

// Null coalescing assignment operator (shorthand)
//$test ??= $integer;

// Null coalescing operator (shorthand)
//var_dump($record ?? $default);

// Ternary operator
//$ternary = !is_null($test) ? $test : $variable === 1 ? $integer : $string;

// Modulus operator
//var_dump(6 % 2);

// Multiply
//var_dump(5 * 2);

// Divide
//var_dump(5 / 2);

//var_dump($ternary);
echo "</pre>";

//bloc -> business logic

if (is_bool($bool) && !is_integer($integer) && is_string($string) || !is_integer($integer)) {
    //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>IF</div>";
} elseif (is_bool($bool)) {
    //echo "<div style='padding: 6px 12px; background-color: red; color: white; font-weight: bold; font-size: 18px;'>ELSEIF</div>";
// Fallback
} else {
    //echo "<div style='padding: 6px 12px; background-color: #333; color: white; font-weight: bold; font-size: 18px;'>ELSE</div>";
}

$animal = "cat";

switch($animal) {
    case "cat":
        //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>{$integer}</div>";
        break;
    case 2:
        //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>{$integer}</div>";
        break;
        default:
        echo "DEFAULT";
}

// Shorthand concatenation (concatenate)
$cat = "cat";
$catTail = " tail";
$cat = $cat . $catTail;
$cat .= $catTail;

// Shorthand addition
$int3 = 1;
$int4 = 5;
$int3 += $int4;

$int3 *= $int4;
$int = 0;
// Increment
$int++;

// Pre-increment
++$int;

// Decrement
$int--;

// Pre-Decrement
--$int;

$array3 = [
    0 => 'var1',
    1 => 'var2',
    2 => 'var3'
];

// $i = Iterrator, 10 hardcode-olt
for ($i = 0; $i <= 10; $i++) {
    //echo $i . "<br/>";
}

// Dinamikus kinyerése a tömb nagyságának/hosszának
for ($i = 0; $i <= (count($array3) - 1); $i++) {
    //echo $array3[$i] . "<br/>";
}

foreach($array3 as $key => $data) {
    //echo $data . "<br/>";
    //echo $array3[$key] . "<br/>";
}

$string = "abc";

/*
while($string !== "abcab") {
    echo $string;
    $string .= "ab";
}

do {
    echo $string;
    $string .= "ab";
} while($string !== "abcab");
*/

// Függvények rendelkeznek scope-okkal
// A függvényeknek átadott paramétereket Argument-nek hívják
function doSomething(string $cat, int $integer = 0) {
    var_dump($cat);
}

//doSomething($cat, $integer);

/*function makeLoop(int $int) {
    echo $int;

    if ($int < 5) {
        // Incremental integer
        makeLoop(++$int);
    }
}
makeLoop(1);*/

$cats = [
    0 => [
        'type' => 'sziami',
        'hair' => [
            'color' => 'gray',
            'length' => 6
        ],
        'food' => ['szaraztap', 'konzerv']
    ]
];

function getCatType($cat) {
    return $cat['type'];
}

function getCat(array $cat) {
    if ($cat['hair']['color'] !== 'gray' || $cat['type'] !== 'sziami') {
        return false;
    }

    if ($cat['type'] !== 'sziami') {
        return false;
    }

    if (!in_array('konzerv', $cat['food'])) {
        return false;
    }

    /*if ($cat['hair']['color'] === 'gray' && $cat['type'] === 'sziami') {
        if ($cat['type'] === 'sziami') {
            if (in_array('konzerv', $cat['food'])) {
                echo "megvan a cica";
            }
        }
    }*/

    echo "megvan a cica";
    return true;
}

// Plural ($cats)
foreach ($cats as $cat) {
    if (getCat($cat) === false) {
        echo getCatType($cat);
    }
}