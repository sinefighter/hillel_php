-- Створення таблиці покупців
CREATE TABLE `customers` (
    `ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `first_name` VARCHAR(50),
    `last_name` VARCHAR(50),
    `email` VARCHAR(100) UNIQUE,
    `phone` VARCHAR(20) UNIQUE
);

-- вставка покупців
INSERT INTO `customers` (`first_name`, `last_name`, `email`, `phone`)
VALUES ('Ігор', 'Скрипченко', 'sinefighter@gmail.com', '+380506711179'),
	   ('Петро', 'Петренко', 'petrenko@gmail.com', '+38050123555'),
	   ('Іван', 'Іваненко', 'ivanenko@gmail.com', '+38050120000');

-- створення таблиці товарів
CREATE TABLE `products` (
    `ID` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100),
    `description` TEXT,
    `price` DECIMAL(10, 2),
    `stock_quantity` INT
);

-- вставка товарів
INSERT INTO `products` (`name`, `description`, `price`, `stock_quantity`) VALUES
    ('iPhone 13', 'Смартфон від Apple', 799.99, 50),
    ('MacBook Air', 'Ноутбук від Apple', 999.99, 30),
    ('AirPods Pro', 'Безпроводні навушники від Apple', 199.99, 100);

-- створення таблиці заказів
CREATE TABLE `orders` (
    `ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `customer_id` INT UNSIGNED,
    `order_date` DATETIME,
    `total_amount` DECIMAL(10, 2),
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`ID`)
);

-- створення таблиці заказів під кожен товар
CREATE TABLE `order_items` (
    `ID` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `order_id` INT UNSIGNED,
    `product_id` INT,
    `quantity` INT,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`ID`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`ID`)
);

-- вставка товарів в замовлення 
INSERT INTO `orders` (`customer_id`, `order_date`, `total_amount`)
VALUES (2, NOW(), 0);

SET @order_id = LAST_INSERT_ID();

-- перший товар
INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`)
VALUES (@order_id, 1, 1);

-- другий товар
INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`)
VALUES (@order_id, 2, 1);

-- оновлення тоталу замовлення
UPDATE `orders`
SET `total_amount` = (SELECT SUM(`price` * `quantity`) FROM `products`
                     JOIN `order_items` ON `products`.`ID` = `order_items`.`product_id`
                     WHERE `order_items`.`order_id` = @order_id)
WHERE `ID` = @order_id;

-- ---------------------------------------------------
INSERT INTO `orders` (`customer_id`, `order_date`, `total_amount`)
VALUES (7, NOW(), 0);

SET @order_id = LAST_INSERT_ID();

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`)
VALUES (@order_id, 3, 2);

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`)
VALUES (@order_id, 1, 3);

UPDATE `orders`
SET `total_amount` = (SELECT SUM(`price` * `quantity`) FROM `products`
                     JOIN `order_items` ON `products`.`ID` = `order_items`.`product_id`
                     WHERE `order_items`.`order_id` = @order_id)
WHERE `ID` = @order_id;

-- SELECT для різних задач:
-- Замовлення для юзера з емейл petrenko@gmail.com
SELECT
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
    `customers`.`email` = 'petrenko@gmail.com';

-- скільки продажів айфона було
SELECT
    SUM(`order_items`.`quantity`) AS `total_iPhone_sold`
FROM
    `order_items`
INNER JOIN
    `products` ON `order_items`.`product_id` = `products`.`ID`
WHERE
    `products`.`ID` = 1

-- видалення заказу
DELETE FROM `orders` WHERE `ID` = 2;