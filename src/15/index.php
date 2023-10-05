<?php
require_once 'Figure.php';
require_once 'Rectangle.php';
require_once 'Circle.php';

try {
	$rect = new Rectangle(10, 220);
	$circle = new Circle(15);

	$rect->getArea();
	$rect->getPerimeter();

	$circle->getArea();
	$circle->getPerimeter();

} catch (Exception $e) {
	echo 'Помилка:' . $e->getMessage();
}
