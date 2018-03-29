<?php
	/**
	* 
	*/
	class Database{
		public $host;
		public $user;
		public $pass;
		public $name;
		
		function __construct(){
			$this->host = "localhost";
			$this->user = "root";
			$this->pass = "";
			$this->name = "tb";
		}	
	}
?>