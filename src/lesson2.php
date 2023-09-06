<?php

// // task 1
// echo "Введіть ваше ім'я: ";
// $name = fgets(STDIN);

// $name = trim($name);

// echo "Привіт, $name!\n";

// // task 2

// echo "Введіть перше число: ";
// $num_1 = fgets(STDIN);

// echo "Введіть друге число: ";
// $num_2 = fgets(STDIN);

// echo "Введіть третє число: ";
// $num_3 = fgets(STDIN);

// $sum = $num_1 + $num_2 + $num_3;
// $avg = ($num_1 + $num_2 + $num_3) / 3;

// echo "Сума чисел: $sum \n";
// echo "Середнє арифметичне: $avg \n";


echo "Введіть числа, розділяючи їх пробілом: ";

$num_str = fgets(STDIN);
$num_str_array = explode(' ', $num_str);
$num_arr = array_map('intval', $num_str_array);

$sum = array_sum($num_arr);
$arr_count = count($num_arr);
$avg = $sum / $arr_count;

echo "Сума чисел: $sum \n";
echo "Середнє арифметичне: $avg \n";



// var_dump($num_arr);