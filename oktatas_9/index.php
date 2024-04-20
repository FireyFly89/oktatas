<?php
require_once('includes/Animals.php');
require_once('includes/Mammals.php');
require_once('includes/Omnivores.php');
require_once('includes/Cat.php');
require_once('includes/Dog.php');
require_once('header.php');
$var1 = 1;

// $akarmi uses reference
function referenceTest(&$akarmi) {
    $akarmi++;
    //return $akarmi;
}

referenceTest($var1);
//echo $var1;

//$cat = new Cat();
//$dog = new Dog();
//echo "Cat goes: " . $cat->behaviour();
//echo "<br/>";
//echo "Dog goes: " . $dog->behaviour();

//var_dump(123 == 123); // true
//echo "<br/>";
//var_dump(123 === 123); // true
//echo "<br/>";
//var_dump("123" == 123); // true
//echo "<br/>";
//var_dump("123" === 123); // false
//echo "<br/>";
//// Type juggling
//var_dump("0123" == 123); // true
//echo "<br/>";
//var_dump("0123" === 123); // false

echo '<div class="container">';

for ($i=0; $i <= 20; $i++) {
    echo '<div class="wrapper" style="margin-left: ' . 2 * $i . 'px;">';

    for ($n=0; $n <= 20; $n++) {
        echo '<div class="line" style="top: ' . (12 * ($n % 3 ? $n : 4)) . 'px;"></div>';
    }

    echo '<div class="line" style="top: ' . rand(10, 100) . 'px;"></div>';
    echo '</div>';
}

echo '</div>';