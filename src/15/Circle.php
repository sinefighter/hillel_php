<?php

class Circle extends Figure {
	private float $radius;

	public function __construct(float $radius) {
		$this->setRadius($radius);
	}

	public function setRadius(float $radius) : void {
		if(!$this->checkSize($radius)) {
			throw new Exception('Радіус повинен бути більше 0.');
		}

		$this->radius = $radius;
	}

	public function area() : float {
        return pi() * pow($this->radius, 2);
    }

    public function perimeter() : float {
        return 2 * pi() * $this->radius;
    }
}