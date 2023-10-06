<?php

trait MessageTrait {

	// write message from terminal
	public function writeMessage() : string {
		return fgets(STDIN);
	}

	// get success message after sendind form/comment
	private function getMessage(string $message) : string {
		return $message;
	}

	// format message for secure
	private function formatMessage($message) : string {
		return htmlspecialchars($message, ENT_QUOTES);
	}
}