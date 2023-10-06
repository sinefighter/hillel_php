<?php

class ContactForm {
	use MessageTrait, FileTrait;

	public function sendForm(string $message) : bool|string {
		$message = $this->formatMessage($message);

		if($this->writeToFile($message, __DIR__ . '/contact.txt')) {
			return $this->getMessage('Форма була відправлена');
		}

		return false;
	}
}