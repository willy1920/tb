<?php
	session_start();

	class Database{
		public $host;
		public $user;
		public $pass;
		public $name;

		public $hostEmail;
		public $emailUser;
		public $emailPass;
		public $SMTPSecure;
		public $Port;
		
		function __construct(){
			$this->host = "localhost";
			$this->user = "root";
			$this->pass = "";
			$this->name = "tb";

			$this->hostEmail = 'stromzivota.web.id';
			$this->emailUser = 'system@stromzivota.web.id';
			$this->emailPass = 'J21Afdn4!';
			$this->SMTPSecure = 'ssl';
			$this->Port = '465';
		}	
	}
?>