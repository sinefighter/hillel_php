<?php
require_once 'Text.php';
require_once 'ChildText.php';

$text = new Text('some text');
echo $text->print() . PHP_EOL;

$child_text = new ChildText('some text');
echo $child_text->print() . PHP_EOL;