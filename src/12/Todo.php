<?php


class Todo {

	private $file;

	/**
	 * Call function to open file
	 * 
	 * @param string $file_path
	 */
	public function __construct (string $file_path) {
		if(!$this -> open_file($file_path)) {
			throw new Exception('Cannot open file');
		}
	}
	
	/**
	 * Add task into file
	 * 
	 * @param string $task
	 * @param Priority $priority
	 * 
	 * @return void
	 */
	public function add_task(string $task, Priority $priority) : void {
		$todo_list = $this -> get_array_from_file();

		if($todo_list) {
			$task_id = (int) $todo_list[count($todo_list) - 1][0] + 1;
		}else{
			$task_id = 1;
		}

		$this -> save_to_file([
			$task_id, 
			$task, 
			$priority -> value, 
			Status::NOT_COMPLETE -> value
		]);

		echo "Завдання #$task_id додано успішно." . PHP_EOL;
	}

	/**
	 * Print sorted tasks from file
	 * 
	 * @return void
	 */
	public function get_tasks() : void {
		$todo_list = $this -> get_array_from_file();

		usort($todo_list, function($a, $b) : int {
			$priorityValues = [
				'High' => 3,
				'Medium' => 2,
				'Low' => 1,
			];
		
			$num1 = $priorityValues[$a[2]] ?? 0;
			$num2 = $priorityValues[$b[2]] ?? 0;

			return $num2 - $num1;
		});

		$output = '';

		foreach($todo_list as $item) {
			$output .= "{$item[0]} | {$item[1]} | {$item[2]} | {$item[3]}" . PHP_EOL;
		}

		echo $output;
	}

	/**
	 * Delete task by ID
	 * 
	 * @param int $task_id
	 * 
	 * @return void
	 */
	public function delete_task(int $task_id) : void {
		$this -> edit_task($task_id, 'delete');
	}

	/**
	 * Make complete task by ID
	 * 
	 * @param int $task_id
	 * 
	 * @return void
	 */
	public function complete_task(int $task_id) : void {
		$this -> edit_task($task_id, 'complete');
	}

	/**
	 * Edit task in depends on action
	 * 
	 * @param int $task_id
	 * @param string $action
	 * 
	 * @return void
	 */
	private function edit_task(int $task_id, string $action) : void {
		$todo_list = $this -> get_array_from_file();
		$check_id = false;

		foreach($todo_list as $key => &$item) {
			if((int) $item[0] === $task_id) {
				if($action === 'delete') {
					array_splice($todo_list, $key, 1);
					echo "Завдання #$task_id успішно видалено" . PHP_EOL;
				}elseif($action === 'complete') {
					$item[3] = 'Complete';
					echo "Новий статус завдання $task_id: Complete." . PHP_EOL;
				}
				$check_id = true;
				break;
			}
		}

		if(!$check_id) {
			throw new Exception('Task not found.');
		}
		$this -> save_to_file($todo_list);
	}

	/**
	 * Open file
	 * 
	 * @param string $file_path
	 * 
	 * @return [type]
	 */
	private function open_file(string $file_path) {
		$this -> file = fopen($file_path, 'a+');
		return $this -> file;
	}

	/**
	 * Return array of tasks from file
	 * 
	 * @return array
	 */
	private function get_array_from_file() : array {
		$file_stream = $this -> file;
		rewind($file_stream);

		$todo_list = [];

		while (!feof($file_stream)) {
			$line = fgets($file_stream);
			if($line){
				$line_parts = explode('|', $line);
				$line_parts = array_map('trim', $line_parts);
				$todo_list[] = $line_parts;
			}
		}
		return $todo_list;
	}

	/**
	 * Save array to file
	 * 
	 * @param array $to_save
	 * 
	 * @return void
	 */
	private function save_to_file(array $to_save) : void {
		$file_stream = $this -> file;

		if(is_array($to_save[0])) {
			ftruncate($file_stream, 0);
			foreach($to_save as $line) {
				fwrite($file_stream, implode("|", $line) . "\n");
			}
		}else{
			fwrite($file_stream, implode("|", $to_save) . "\n");
		}
	}

	function __destruct () {
		fclose($this -> file);
	}
}