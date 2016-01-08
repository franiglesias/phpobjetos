<?php

class AddressDTO {
	
	private $street;
	private $extra;
	private $zip;
	private $city;
	
	public function __construct($street, $extra, $zip, $city)
	{
		// Validation stuff should be here
		
		$this->street = $street;
		$this->extra = $extra;
		$this->zip = $zip;
		$this->city = $city;
	}
}


class User
{
	private $name;
	private $email;
	
	private $address;
	
	// More stuff
	
	function setAddress(AddressDTO $address)
	{
		$this->address = $address;
	}
}

$address = new AddressDTO('Calle principal 14', '', '1234', 'My Town');
$user = new User();
$user->setAddress($address);
print_r($user);

?>