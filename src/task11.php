<?php
function fibonacci(int $limit) {
	$fib1 = 0;
	$fib2 = 1;
	while($fib1 < $limit) {
		yield $fib1;
		$fib1 = $fib1 + $fib2;
		$fib2 = $fib1 - $fib2;
	}
}

function fibonacciArr(int $limit) {
	$fib1 = 0;
	$fib2 = 1;
	$fib_arr = [];
	while($fib1 < $limit) {
		$fib_arr[] = $fib1;
		$fib1 = $fib1 + $fib2;
		$fib2 = $fib1 - $fib2;
		
	}
	return $fib_arr;
}

$memoryStart = memory_get_usage();

$fibonacci = fibonacci(100);
// $fibonacciArr = fibonacciArr(100);

foreach($fibonacci as $number) {
	echo $number . PHP_EOL;
}
// foreach($fibonacciArr as $number) {
// 	echo $number . PHP_EOL;
// }

$memoryEnd = memory_get_usage();

echo 'Memory: ' . $memoryEnd - $memoryStart . PHP_EOL;