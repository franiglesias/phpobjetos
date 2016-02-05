<?php 

class Client {
	private $service;
	
	public function __construct(Service $service) {
		$this->service = $service;
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


$client = new Client(new Service());
$client->doSomething();

?>
