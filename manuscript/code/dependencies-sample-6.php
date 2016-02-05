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
	public function doService() {
		echo 'Performed by Service';
	}
}

class ServiceAdapter implements ServiceInterface {
	private $service;
	
	public function __construct(Service $service)
	{
		$this->service = $service;
	}
	
	public function doTheThing()
	{
		$this->service->doService();
	}
}

class NewService {
	public function theMethod()
	{
		echo 'Performed by New Service';
	}
}

class NewServiceAdapter implements ServiceInterface {
	private $service;
	
	public function __construct(NewService $service)
	{
		$this->service = $service;
	}
	
	public function doTheThing()
	{
		$this->service->theMethod();
	}
	
}

$client = new Client(new ServiceAdapter(new Service()));
$client->doSomething();
echo chr(10);

$client2 = new Client(new NewServiceAdapter(new NewService()));
$client2->doSomething();

?>
