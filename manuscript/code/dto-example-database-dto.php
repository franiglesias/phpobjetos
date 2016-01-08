<?php

class DBSettings {

	private $host;
	private $port;
	private $user;
	private $password;
	private $database;
	
	public function __construct($host, $port, $user, $password, $database = null)
	{
		// Validation stuff
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
	}
	
	public function getHost()
	{
		return $this->host;
	}
	
	public function getPort()
	{
		return $this->port;
	}
	
	public function getUser()
	{
		return $this->user;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function getDatabase()
	{
		return $this->database;
	}
	
}

class DBConnector
{
	private $settings;
	
	public function connect(DBSettings $settings)
	{
		$this->settings = $settings;
		// Connection stuff
	}
}

?>