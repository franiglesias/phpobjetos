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


// Service has change its public interface

class Service {
	public function doService() {
		echo 'Performed by Service';
	}
}

// We change Adapter according to the changes in Service

class ServiceAdapter implements ServiceInterface {
	private $service;
	
	public function __construct(Service $service)
	{
		$this->service = $service;
	}
	
	// We need to change the way the adapter uses Service
	
	public function doTheThing()
	{
		$this->service->doService();
	}
}


$client = new Client(new ServiceAdapter(new Service()));
$client->doSomething();

?>
