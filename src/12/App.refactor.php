<?php
class App 
{ //відкриваюча скобка повинна знаходитись на окремому рядку
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
	public function run(): void {
        echo "Оберіть, що ви хочете зробити:\n";
        echo "1. Отримати список завдань\n";
        echo "2. Додати нове завдання\n";
        echo "3. Відмітити завдання виконаним\n";
        echo "4. Видалити завдання\n";
        echo "5. Конвертувати в JSON\n";
        
        $input = fgets(STDIN);
        $input = (int)trim($input);

		match ($input) {
			1 => $this->getTasks(),
			2 => $this->addTask(),
			3 => $this->completeTask(),
			4 => $this->deleteTask(),
			5 => $this->createJsonFile(),
			default => $this->invalidInput($input, 'run')
		};
    }

	/**
	 * @return void
	 */
	private function getTasks(): void { //назва методів повинна бути в кемелКейс (тут і надалі)
        $this->todo->getTasks();
    }

    /**
     * @return void
     */
    private function addTask(): void {
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
            1 => $this->todo->addTask($task_text, Priority::HIGH),
            2 => $this->todo->addTask($task_text, Priority::MEDIUM),
            3 => $this->todo->addTask($task_text, Priority::LOW),
            default => $this->invalidInput($task_priority, 'addTask')
        };
    }

    /**
     * @return void
     */
    private function completeTask(): void {
        echo "Введіть номер завдання:\n";
        $input = fgets(STDIN);
        $input = (int)trim($input);

        $this->todo->completeTask($input);
    }

    /**
     * @return void
     */
    private function deleteTask(): void {
        echo "Введіть номер завдання для видалення:\n";
        $input = fgets(STDIN);
        $input = (int)trim($input);

        $this->todo->deleteTask($input);
    }

    /**
     * @return void
     */
    private function createJsonFile(): void {
        echo "Введіть назву файлу з розширенням .json:\n";
        $input = fgets(STDIN);
        $input = trim($input);

        if ($input) {
            $this->todo->createJsonFile($input);
        } else {
            $this->todo->createJsonFile();
        }
    }

    /**
     * @param int $input
     * @param string $function
     * 
     * @return void
     */
    private function invalidInput(int $input, string $function): void {
        echo "Дії під номером $input не існує. Спробуйте заново.\n";
		$this->$function();
    }
}