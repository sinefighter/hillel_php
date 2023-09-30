<?php 
class ChildText extends Text {
	public function print() : string {
		return strtoupper($this->text);
	}
}