<?php

require_once('Priority.php');
require_once('Status.php');
require_once('Todo.php');

$todo = new Todo(__DIR__ . '/todo.txt');

// $todo -> set_file_path(__DIR__ . '/todo.txt');

// echo 'Введіть завдання:' . PHP_EOL;
// $input = fgets(STDIN);

// $input = trim($input);

// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);
// $todo -> add_task('Task exaple', Priority::MEDIUM);
// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);
// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);
// $todo -> add_task('Task exaple', Priority::MEDIUM);
// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);
// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);
// $todo -> add_task('Task exaple', Priority::MEDIUM);
// $todo -> add_task('Task exaple', Priority::HIGH);
// $todo -> add_task('Task exaple', Priority::LOW);

// print_r($todo -> get_tasks());

try {
	$todo -> complete_task(14);
	// $todo -> delete_task(16);
} catch (Exception $e) {
	echo 'Сталася помилка:' . $e->getMessage() . PHP_EOL;
}

