<?php
require_once 'DB.php';
require_once 'config.php';

try {
	$db = new DB(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$sql_create_table = "
        CREATE TABLE IF NOT EXISTS `customers` (
            `ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            `first_name` VARCHAR(50),
            `last_name` VARCHAR(50),
            `email` VARCHAR(100) UNIQUE,
            `phone` VARCHAR(20) UNIQUE
        )
    ";
	$db->createTable($sql_create_table);

	$sql_create_table = "
		CREATE TABLE IF NOT EXISTS `products` (
			`ID` INT PRIMARY KEY AUTO_INCREMENT,
			`name` VARCHAR(100),
			`description` TEXT,
			`price` DECIMAL(10, 2),
			`stock_quantity` INT
		);
    ";
	$db->createTable($sql_create_table);

	$sql_create_table = "
		CREATE TABLE IF NOT EXISTS `orders` (
			`ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			`customer_id` INT UNSIGNED,
			`order_date` DATETIME,
			`total_amount` DECIMAL(10, 2),
			FOREIGN KEY (`customer_id`) REFERENCES `customers`(`ID`)
		);
    ";
	$db->createTable($sql_create_table);

	$sql_create_table = "
		CREATE TABLE IF NOT EXISTS `order_items` (
			`ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			`order_id` INT UNSIGNED,
			`product_id` INT,
			`quantity` INT,
			FOREIGN KEY (`order_id`) REFERENCES `orders`(`ID`),
			FOREIGN KEY (`product_id`) REFERENCES `products`(`ID`)
		);
    ";
	$db->createTable($sql_create_table);

	/**
	 * Insert products
	 */

	$db->insertData(
		'products', 
		['name', 'description', 'price', 'stock_quantity'], 
		['iPhone 13', 'Смартфон від Apple', 799.99, 50]
	);

	$db->insertData(
		'products', 
		['name', 'description', 'price', 'stock_quantity'], 
		['MacBook Air', 'Ноутбук від Apple', 999.99, 30]
	);

	$db->insertData(
		'products', 
		['name', 'description', 'price', 'stock_quantity'], 
		['AirPods Pro', 'Безпроводні навушники від Apple', 199.99, 100]
	);

	/**
	 * Insert customers
	 */

	$db->insertData(
		'customers', 
		['first_name', 'last_name', 'email', 'phone'], 
		['Ігор', 'Скрипченко', 'sinefighter@gmail.com', '+380506711179']
	);
	$db->insertData(
		'customers', 
		['first_name', 'last_name', 'email', 'phone'], 
		['Петро', 'Петренко', 'petrenko@gmail.com', '+38050123555']
	);
	$db->insertData(
		'customers', 
		['first_name', 'last_name', 'email', 'phone'], 
		['Іван', 'Іваненко', 'ivanenko@gmail.com', '+38050120000']
	);

	/**
	 * create order
	 */
	$db->createOrder(2, [3, 2]);
	$db->createOrder(1, [2, 1]);
	$db->createOrder(3, [1, 3, 2]);

	$db->getTotalProductsSold(2);

	$db->getCustomerOrdersByEmail('sinefighter@gmail.com');

	$db->deleteOrder(3);

} catch(Exception $e) {
	echo 'Error: ' . $e->getMessage();
}