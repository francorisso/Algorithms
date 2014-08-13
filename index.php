<?php

use test\Algorithms;

include("test/algorithms.php");


$o_algorithms = new Algorithms();
$result = $o_algorithms->array_intersect_custom(
    array(3,4,5),
    array(1,2,5,7,8,10),
    array(5,2)
);

print_r($result);