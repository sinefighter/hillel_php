<?php

class BankAccount {
	private string $bill_number;
	private float $balance;

	/**
	 * @param string $bill_number
	 * @param float $balance
	 */
	public function __construct(string $bill_number, float $balance = 0) {
		$this->setBillNumber($bill_number);
		$this->setBalance($balance);
	}

	/**
	 * @param string $bill_number
	 * 
	 * @return void
	 */
	public function setBillNumber(string $bill_number) : void {
		$this->bill_number = $bill_number;
	}

	/**
	 * @param string $balance
	 * 
	 * @return void
	 */
	public function setBalance(string $balance) : void {
		$this->balance = $balance;
	}

	/**
	 * @return string
	 */
	public function getBillNumber() : string {
		return $this->bill_number;
	}

	/**
	 * @return float
	 */
	public function getBalance() : float {
		return $this->balance;
	}

	/**
	 * @param float $amount
	 * 
	 * @return void
	 */
	public function deposit(float $amount) : void {
		$this->balance += $amount;
	}

	/**
	 * @param float $amount
	 * 
	 * @return void
	 */
	public function withdraw(float $amount) : void {
		if($amount > 0) {
			if($this->balance - $amount >= 0) {
				$this->balance -= $amount;
			}else{
				throw new Exception('Неможна зняти більше, ніж є на рахунку.');
			}
		}else{
			throw new Exception('Сума до зняття повинна бути більше 0.');
		}
		
	}
}