<?php

class Bill {
	private string $bill_number;
	private float $balance;

	public function setBillNumber(string $bill_number) : void {
		$this->$bill_number = $bill_number;
	}

	public function setBalance(string $balance) : void {
		$this->$balance = $balance;
	}

	public function getBillNumber(string $bill_number) : string {
		return $this->$bill_number;
	}

	public function getBalance(string $balance) : float {
		return $this->$balance;
	}

	public function increaseBalance(string $bill_number, float $count) : void {
		
	}

	public function decreaseBalance(string $bill_number, float $count) : void {

	}

}