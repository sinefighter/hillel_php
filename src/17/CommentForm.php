<?php

class CommentForm {
	use MessageTrait, FileTrait;

	public function sendComment(string $message) : bool|string {
		$message = $this->formatMessage($message);

		if($this->writeToFile($message, __DIR__ . '/comment.txt')) {
			return $this->getMessage('Коментар був відправлений');
		}

		return false;
	}
}