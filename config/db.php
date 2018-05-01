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

			$this->hostEmail = 'mail.tunasbangsa.sch.id';
			$this->emailUser = 'system@tunasbangsa.sch.id';
			$this->emailPass = 'J21Afdn4!';
			$this->SMTPSecure = 'ssl';
			$this->Port = '465';
		}	
	}
?>