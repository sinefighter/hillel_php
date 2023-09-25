<?php
class App {
	private $todo;

	/**
	 * @param string $todo_file_path
	 */
	public function __construct(string $todo_file_path) {
		$this->todo = new Todo($todo_file_path);
	}

	/**
	 * @return void
	 */
	public function run() : void {
        echo "Оберіть, що ви хочете зробити:\n";
        echo "1. Отримати список завдань\n";
        echo "2. Додати нове завдання\n";
        echo "3. Відмітити завдання виконаним\n";
        echo "4. Видалити завдання\n";
        echo "5. Конвертувати в JSON\n";
        
        $input = fgets(STDIN);
        $input = (int)trim($input);

        try {
            match ($input) {
                1 => $this->get_tasks(),
                2 => $this->add_task(),
                3 => $this->complete_task(),
                4 => $this->delete_task(),
                5 => $this->create_json_file(),
                default => $this->invalid_input($input, 'run')
            };
        } catch (Exception $e) {
            echo 'Сталася помилка: ' . $e->getMessage() . PHP_EOL;
        }
    }

	/**
	 * @return void
	 */
	private function get_tasks() : void {
        $this->todo->get_tasks();
    }

    /**
     * @return void
     */
    private function add_task() : void {
        echo "Введіть завдання:\n";
        $task_text = fgets(STDIN);
        $task_text = trim($task_text);

        echo "Введіть пріорітет:\n";
        echo "1. High\n";
        echo "2. Medium\n";
        echo "3. Low\n";
        
        $task_priority = fgets(STDIN);
        $task_priority = (int)trim($task_priority);

        match ($task_priority) {
            1 => $this->todo->add_task($task_text, Priority::HIGH),
            2 => $this->todo->add_task($task_text, Priority::MEDIUM),
            3 => $this->todo->add_task($task_text, Priority::LOW),
            default => $this->invalid_input($task_priority, 'add_task')
        };
    }

    /**
     * @return void
     */
    private function complete_task() : void {
        echo "Введіть номер завдання:\n";
        $input = fgets(STDIN);
        $input = (int)trim($input);

        $this->todo->complete_task($input);
    }

    /**
     * @return void
     */
    private function delete_task() : void {
        echo "Введіть номер завдання для видалення:\n";
        $input = fgets(STDIN);
        $input = (int)trim($input);

        $this->todo->delete_task($input);
    }

    /**
     * @return void
     */
    private function create_json_file() : void {
        echo "Введіть назву файлу з розширенням .json:\n";
        $input = fgets(STDIN);
        $input = trim($input);

        if ($input) {
            $this->todo->create_json_file($input);
        } else {
            $this->todo->create_json_file();
        }
    }

    /**
     * @param int $input
     * @param string $function
     * 
     * @return void
     */
    private function invalid_input(int $input, string $function) : void {
        echo "Дії під номером $input не існує. Спробуйте заново.\n";
		$this -> $function();
    }
}