<?php

class DB 
{
	private $pdo;

	public function __construct(string $dbHost, string $dbName, string $dbUser, string $dbPass)
	{
		$this->pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

		if(!$this->pdo) {
			throw new Exception('DB connect error');
		}
	}

	public function createTable(string $sql): void
	{
		$stmt = $this->pdo->prepare($sql);

		$stmt->execute();
	}

	public function insertData(string $table, array $columns, array $data): void 
	{
		$params = array_map(function ($column) {
            return ":$column";
        }, $columns);

		$sql = "INSERT INTO `$table` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $params) . ")";

		$stmt = $this->pdo->prepare($sql);

        $values = array_combine($columns, $data);

        $stmt->execute($values);
	}

	public function createOrder(int $customerID, array $productIDs): void 
	{
		// Вставляем заказ в таблицу `orders`
		$insertOrderSQL = "INSERT INTO `orders` (`customer_id`, `order_date`, `total_amount`) VALUES (:customer_id, NOW(), 0)";
		$stmt = $this->pdo->prepare($insertOrderSQL);
		$stmt->execute([
			"customer_id" => $customerID
		]);

		// Получаем ID созданного заказа
		$orderID = $this->pdo->lastInsertId();

		// Вставляем товары в таблицу `order_items` для каждого продукта
		$insertOrderItemSQL = "INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`) VALUES (:order_id, :product_id, 1)";
		$stmt = $this->pdo->prepare($insertOrderItemSQL);

		foreach ($productIDs as $productID) {
			$stmt->execute([
				"order_id" => $orderID, 
				"product_id" => $productID
			]);
		}

		$this->updateTotalAmount($orderID);
	}

	private function updateTotalAmount(int $orderID): void
	{
        // Обновляем `total_amount` в таблице `orders`
        $updateTotalAmountSQL = "UPDATE `orders` SET `total_amount` = (SELECT SUM(`price` * `quantity`) FROM `products`
                               JOIN `order_items` ON `products`.`ID` = `order_items`.`product_id`
                               WHERE `order_items`.`order_id` = ?) WHERE `ID` = ?";
        $stmt = $this->pdo->prepare($updateTotalAmountSQL);
        $stmt->execute([$orderID, $orderID]);
    }

	public function getCustomerOrdersByEmail(string $email): void
	{
        $sql = "SELECT
                    `customers`.`first_name`,
                    `customers`.`last_name`,
                    `orders`.`order_date`,
                    `products`.`name` AS `product_name`,
                    `order_items`.`quantity`,
                    `products`.`price`
                FROM
                    `customers`
                INNER JOIN
                    `orders` ON `customers`.`ID` = `orders`.`customer_id`
                INNER JOIN
                    `order_items` ON `orders`.`ID` = `order_items`.`order_id`
                INNER JOIN
                    `products` ON `order_items`.`product_id` = `products`.`ID`
                WHERE
                    `customers`.`email` = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

	public function getTotalProductsSold(int $product_id): void 
	{
        $sql = "SELECT
                    SUM(`order_items`.`quantity`) AS `total_product_sold`
                FROM
                    `order_items`
                INNER JOIN
                    `products` ON `order_items`.`product_id` = `products`.`ID`
                WHERE
                    `products`.`ID` = :product_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
			"product_id" => $product_id
		]);

        var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    }

	public function deleteOrder(int $orderID): void 
	{
        $sql = "DELETE FROM `orders` WHERE `ID` = :orderID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
			'orderID' => $orderID
		]);
    }
}