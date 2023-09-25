<?php

require_once('Priority.php');
require_once('Status.php');
require_once('Todo.php');
require_once('App.php');

$app = new App(__DIR__ . '/todo.txt');
$app->run();