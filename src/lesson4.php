<?php
echo "Введіть кількість елементів масиву (одне число) \n";
$arr_size = (int) fgets(STDIN);

for($i = 0; $i < $arr_size; $i++) {
	$array[] = rand(1, 100);
}

$arr_min = $array[0];
$arr_max = $array[0];

foreach($array as $item) {
	if($item > $arr_max) {
		$arr_max = $item;
	}
	if($item < $arr_min) {
		$arr_min = $item;
	}
}

echo "Максимум: $arr_max" . PHP_EOL;
echo "Мінімум: $arr_min" . PHP_EOL;

// sort($array);

$count_arr = count($array);

for($i = 0; $i < $count_arr; $i++) {
	$min = $array[$i];
	$min_index = $i;
	$temp_value = $array[$i];

	for($j = $i; $j < $count_arr; $j++) {
		if($array[$j] < $min) {
			$min = $array[$j];
			$min_index = $j;
			$temp_value = $array[$i];
		}
	}
	$array[$i] = $min;
	$array[$min_index] = $temp_value;
}

print_r($array);