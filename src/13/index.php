<?php
require_once 'BankAccount.php';

$account1 = new BankAccount("5681234557");
$account2 = new BankAccount("9876543210", 3000);

try {
	$account1->deposit(500);
	$account2->withdraw(200);
} catch (Exception $e){
	echo 'Виникла помилка: ',  $e->getMessage(), "\n";
	exit;
}


echo "Баланс рахунку 1: " . $account1->getBalance() . PHP_EOL;
echo "Баланс рахунку 2: " . $account2->getBalance() . PHP_EOL;