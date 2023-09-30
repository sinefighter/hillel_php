<?php
class Text {
	protected $text;

	public function __construct(string $text) {
		$this->text = $text;
	}

	public function print() : string {
		return ucfirst($this->text);
	}
}