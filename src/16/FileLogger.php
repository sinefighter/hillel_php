<?php
class FileLogger implements InterfaceLogger {
	private $filePath;

	public function __construct(string $filePath) {
		$this->filePath = $filePath;

		if (!is_file($this->filePath)) {
            touch($this->filePath);
        }
	}

	public function log(string $message, Level $level) : void {
		$level = $level->value;
        $date = new DateTime();
        $log_entry = "[{$date->format('Y-m-d H:i:s')}] [{$level}] {$message}\n";

        file_put_contents($this->filePath, $log_entry, FILE_APPEND);
    }
}