<?php

trait FileTrait {
	// write message to file specific file
	private function writeToFile($message, $filename) : bool {

		$fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

		if ($fileExtension !== 'txt') {
			throw new Exception('Файл повинен мати розширення .txt');
        }
		
		if(!file_exists($filename)) {
            touch($filename);
		}

        if(!file_put_contents($filename, $message, FILE_APPEND)) {
			throw new Exception('Невдалось записати у файл');
		}

		return true;
	}
}