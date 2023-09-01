<?php

// task 1
echo "Введіть ваше ім'я: ";
$name = fgets(STDIN);

$name = trim($name);

echo "Привіт, $name!\n";

// task 2

echo "Введіть перше число: ";
$num_1 = fgets(STDIN);

echo "Введіть друге число: ";
$num_2 = fgets(STDIN);

echo "Введіть третє число: ";
$num_3 = fgets(STDIN);

$sum = $num_1 + $num_2 + $num_3;
$avg = ($num_1 + $num_2 + $num_3) / 3;

echo "Сума чисел: $sum \n";
echo "Середнє арифметичне: $avg \n";
