<?php 

interface ServiceInterface {
	public function doTheThing();
}

class Client {
	private $service;
	
	public function __construct(ServiceInterface $service) {
		$this->service = $service;
	}
	public function doSomething() {
		$this->service->doTheThing();
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
