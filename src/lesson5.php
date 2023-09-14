<?php

/**
 * task 7
 */

// function circleSquare($r) {
// 	return round(M_PI * $r**2, 2);
// }

// $circle_square = circleSquare(10);

// echo $circle_square . PHP_EOL;

// function power($number, $power) {
// 	return $number ** $power;
// }

// $power = power(2, 8);

// echo $power . PHP_EOL;

// variant 2

$number = 2;

function power(&$number, $power) {
	$number **= $power;
}

power($number, 8);

echo $number . PHP_EOL;

// -----------------------------------

$r = 12;

function circleSquare(&$r) {
	$r = round(M_PI * $r**2, 2);
}

circleSquare($r);

echo $r . PHP_EOL;