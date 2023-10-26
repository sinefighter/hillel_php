<?php
require_once 'Router.php';

try {
    $router = new Router();
    $router->entryPoint();
} catch (Exception $e) {
    echo 'Помилка: ' . $e->getMessage();
}