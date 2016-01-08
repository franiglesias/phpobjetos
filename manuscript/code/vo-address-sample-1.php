<?php

class User {
	
	private $name;
	private $email;
	
	private $street;
	private $extra;
	private $zip;
	private $city;
	
	// More stuff
	
	public function setAddress($street, $extra, $zip, $city)
	{
		// Validation stuff should be here
		
		$this->street = $street;
		$this->extra = $extra;
		$this->zip = $zip;
		$this->city = $city;
	}
}

?>