<?php
abstract class Figure {
	abstract protected function area() : float;
	abstract protected function perimeter() : float;

	public function getArea() : void {
		echo 'Площа: ' . $this->area() . PHP_EOL;
	}
	public function getPerimeter() : void {
		echo 'Периметр: ' . $this->perimeter() . PHP_EOL;
	}

	protected function checkSize(float $value) : bool {
		return $value > 0;
	}
}