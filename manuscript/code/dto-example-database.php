<?php

class DBConnector {

	private $host;
	private $port;
	private $user;
	private $password;
	private $database;
	
	public function connect($host, $port, $user, $password, $database = null)
	{
		// Validation stuff
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		
		// Connection stuff
	}
}

?>