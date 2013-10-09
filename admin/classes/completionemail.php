<?php


require_once("../library/mail.php");

class completionemail {

	protected $to;
	private $from = "generalmail@burksmedicalconsulting.com";
	private $subject = "test completion email subject";
	
	public $jobid;
	
	public function send()
	{
	
		$message = "TEST COMPLETION EMAIL MESSAGE";
		$this->to = "jamesclaytondavidson@gmail.com";
		
		try
		{
			$mail = new Mail();
			$mail->protocol = "mail";
			$mail->hostname = "relay-hosting.secureserver.net";
			$mail->port = 25;
			$mail->timeout = 5;
			$mail->setTo($this->to);
			$mail->setFrom($this->from);
			$mail->setSender($this->from);
			$mail->setSubject(html_entity_decode($this->subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml($message);
			$mail->send();
			
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ', $e->getMessage(), "\n";
		}
	
	}

}