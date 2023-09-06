<?php

echo "Введіть число: \n";

$num = (int) fgets(STDIN);

// switch($num) {
// 	case 1: $color = 'green'; break;
// 	case 2: $color = 'red'; break;
// 	case 3: $color = 'blue'; break;
// 	case 4: $color = 'brown'; break;
// 	case 5: $color = 'violet'; break;
// 	case 6: $color = 'black'; break;
// 	default: $color = 'white'; break;
// }


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