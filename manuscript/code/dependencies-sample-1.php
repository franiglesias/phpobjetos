<?php 

class Client {
	private $service;
	
	public function __construct() {
		$this->service = new Service();
	}
	public function doSomething() {
		$this->service->doTask();
	}
}

class Service {
	public function doTask() {
		echo 'Performed by Service';
	}
}


$client = new Client();
$client->doSomething();

?>
