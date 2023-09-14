<?php

/**
 * task 7
 */

// ----------------------- variant 1 (with return) -----------------------------

function circleSquare($r) {
	return round(M_PI * $r**2, 2);
}

$circle_square = circleSquare(10);

echo $circle_square . PHP_EOL;

// -------------------------------------------

function power($number, $power) {
	return $number ** $power;
}

$power = power(2, 8);

echo $power . PHP_EOL;

// ----------------------- variant 2 (without return) -----------------------------

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

/**
 * Task 8
 */

function product(int $num1, int $num2, callable $callback = null) : int {
	$product = $num1 * $num2;
	// var_dump($callback);
	if(is_callable($callback)) {
		$callback($product);
	}
	return $product;
}

product(10, 20, function(int $arg){
	echo $arg;
});
