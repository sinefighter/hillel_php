<?php

class Rectangle extends Figure {
	private float $width;
	private float $height;

	public function __construct(float $width, float $height) {
		$this->setWidth($width);
		$this->setHeight($height);
	}

	public function setWidth(float $width) : void {
		if(!$this->checkSize($width)) {
			throw new Exception('Ширина повинна бути більше 0.');
		}

		$this->width = $width;
	}

	public function setHeight(float $height) : void {
		if(!$this->checkSize($height)) {
			throw new Exception('Висота повинна бути більше 0.');
		}

		$this->height = $height;
	}

	public function area() : float {
        return $this->height * $this->width;
    }

    public function perimeter() : float {
        return 2 * ($this->height + $this->width);
    }
}