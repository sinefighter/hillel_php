<?php

class Router
{
    public function entryPoint(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $this->typeGetRequest();
        } elseif ($method === 'POST') {
            $this->typePostRequest();
        } else {
            throw new Exception('Метод не підтримується');
        }
    }

    private function typeGetRequest(): void
	{
		if (isset($_GET['name'])) {
			$name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
			
			echo "Привіт, " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '!';
		} else {
			throw new Exception('Немає необхідного параметру name');
		}
	}


    private function typePostRequest(): void
    {
        $number1 = filter_input(INPUT_POST, 'number1', FILTER_VALIDATE_INT);
        $number2 = filter_input(INPUT_POST, 'number2', FILTER_VALIDATE_INT);

        if ($number1 !== false && $number2 !== false) {
            $result = $number1 + $number2;
            echo "Результат: " . $result;
        } else {
            throw new Exception('Помилка: Некоректні дані для обробки');
        }
    }
}