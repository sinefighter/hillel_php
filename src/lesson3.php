<?php

/* Homework Task 5 */
echo "Введіть число: \n";

$num = (int) fgets(STDIN);

switch($num) {
	case 1: $color = 'green'; break;
	case 2: $color = 'red'; break;
	case 3: $color = 'blue'; break;
	case 4: $color = 'brown'; break;
	case 5: $color = 'violet'; break;
	case 6: $color = 'black'; break;
	default: $color = 'white'; break;
}


if($num === 1) {
	$color = 'green';
} else if($num === 2) {
	$color = 'red';
} else if($num === 3) {
	$color = 'blue';
} else if($num === 4) {
	$color = 'brown';
} else if($num === 5) {
	$color = 'violet';
} else if($num === 6) {
	$color = 'black';
} else {
	$color = 'white';
}

echo $color . PHP_EOL;

/* Homework Task 4 */

echo 42 === "42";
echo 42 == "42";

echo 4.2 === "4.2";
echo 4.2 == "4.2";

echo true === "1";
echo true == "1";

echo 1 === true;
echo 2 == true;

echo [1, 2, 3] === true;
echo [1, 2, 3] == true;

echo null === false;
echo null == false;

echo null === "";
echo null == "";

echo null === 0;
echo null == 0;

echo false == "false";

echo [1, 2, 3] === [1, 2, 3];
echo [1, 2, 3] == [1, 2, 3];

$arr1 = [1, 2, 3];
$arr2 = [1, 2, 3];

echo $arr1 === $arr2;
echo $arr1 == $arr2;

echo [] === false;
echo [] == false;
