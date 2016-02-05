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

// We don't touch Service

class Service {
	public function doTask() {
		echo 'Performed by Service';
	}
}

// We create an adpater

class ServiceAdapter implements ServiceInterface {
	private $service;
	
	public function __construct(Service $service)
	{
		$this->service = $service;
	}
	
	public function doTheThing()
	{
		$this->service->doTask();
	}
}


$client = new Client(new ServiceAdapter(new Service()));
$client->doSomething();

?>
