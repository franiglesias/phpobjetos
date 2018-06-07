<?php

interface Loggable {
	public function log($message);
	public function write();
}

class Emailer implements Loggable {
	
	private $messages;
	
	public function log($message)
	{
		$this->messages[] = $message;
	}
	
	public function write()
	{
		foreach ($this->messages as $message) {
			// Write message to email.log file
		}
		$this->messages = array();
	}
}


class DataBase implements Loggable {
	
	private $messages;
	
	public function log($message)
	{
		$this->messages[] = $message;
	}
	
	public function write()
	{
		foreach ($this->messages as $message) {
			// Write message to database.log file
		}
		$this->messages = array();
	}

}


class Logger
{
	private $objects;
	
	public function register(Loggable $object)
	{
		$this->objects[] = $object;
	}
	
	public function write()
	{
		foreach ($this->objects as $object) {
			$object->write();
		}
	}
	
}
