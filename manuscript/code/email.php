<?php


class Email {
	private $email;
	
	public function __construct($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			throw new InvalidArgumentException("$email is not a valid email");
		}
		$this->email = $email;
	}
	
	public function getValue()
	{
		return $this->email;
	}
}

$emailsToTry = array(
	'franiglesias@mac.com',
	'franiglesias@',
	'@example.com',
	'user@example'
);

foreach ($emailsToTry as $email) {
	try {
		$emailObject = new Email($email);
	} catch (Exception $e) {
		echo $e->getMessage().chr(10);
	}

}

?>