<?php

function replace_words(array $words) : void {
	ob_start();

	require_once('content.php');
	
	$content = ob_get_contents();

	foreach ($words as $word) {
		$content = str_replace($word, "<b>$word</b>", $content);
	}
	
	ob_clean();
	
	echo $content;
}

replace_words(['Lorem', 'text']);