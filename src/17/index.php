<?php
require_once 'FileTrait.php';
require_once 'MessageTrait.php';
require_once 'ContactForm.php';
require_once 'CommentForm.php';

// code for Form
try {
	$form = new ContactForm;

	echo "Введіть дані форми:\n";
	$message = $form->writeMessage();
	
	if($sendResponse = $form->sendForm($message)) {
		echo $sendResponse . PHP_EOL;
	}
} catch(Exception $e) {
	echo "Виникла помилка з формою: {$e->getMessage()}\n";
}

// code for Comment
try {
	$comment = new CommentForm;

	echo "Введіть коментар:\n";
	$message = $comment->writeMessage();

	if($sendResponse = $comment->sendComment($message)) {
		echo $sendResponse . PHP_EOL;
	}
} catch(Exception $e) {
	echo "Виникла помилка з коментарем: {$e->getMessage()}\n";
}



