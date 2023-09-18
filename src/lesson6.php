<?php

/**
 * Task 9. Part 1
 */

$filename = __DIR__ . '/log.txt';
$file = fopen($filename, 'a+');

if (!$file) {
    echo "Помилка відкриття файлу.\n";
    exit;
}

echo "Введіть дані (або введіть 'exit' для завершення):\n";

while (true) {
    $input = fgets(STDIN);

    $input = trim($input);

    if ($input === 'exit') {
        break;
    }

    fwrite($file, $input . " ");
}

fwrite($file, "\n");

fclose($file);

echo "Запис у файл завершено успішно.\n";

/**
 * Task 9. Part 2
 */

$file = fopen($filename, 'r');
$cursor = -1;

fseek($file, $cursor, SEEK_END);
$char = fgetc($file);

while ($char === "\n" || $char === "\r") {
    fseek($file, $cursor--, SEEK_END);
    $char = fgetc($file);
}

$line = '';
while ($char !== false && $char !== "\n" && $char !== "\r") {
    $line = $char . $line;
    fseek($file, $cursor--, SEEK_END);
    $char = fgetc($file);
}

fclose($file);

echo $line . PHP_EOL;