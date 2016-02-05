<?php

class Email {
	private $address;

	function __construct($address) {
		if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
			throw new InvalidArgumentException("$address is not a valid email");
		}
 		$this->address = $address;
	}
	
	public function getAdress()
	{
		return $this->address;
	}
	
}

$myEmail = new Email('franiglesias@mac.com');
$otherEmail = new Email('other@example.com');


?>