<?php

class Money {
	private $amout;
	private $currency;
	
	public function __construct($amount, $currency) {
		$this->amount = $amount;
		$this->currency = $currency;
	}
	
	public function getAmount() {
		return $this->amount;
	}
	
	public function incrementByPercentage($pct) {
		return new Money($this->amount*(1+$pct), $this->currency);
	}
}

$price = new Money(100, 'EUR');
$newPrice = $price->incrementByPercentage(.10);
echo $newPrice->getAmount();

?>