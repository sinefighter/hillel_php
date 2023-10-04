<?php
interface InterfaceLogger {
	public function log(string $message, Level $level) : void;
}