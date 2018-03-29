<?php

	class db
	{
		// Propriedades
		private $dbhost = 'localhost';
		private $dbuser = 'postgres';
		private $dbpass = 'admin';
		private $dbname = 'postgres';
		
		//Conexão
		public function connect()
		{
			$pg_connect_str = "pgsql:host=$this->dbhost;dbname=$this->dbname;";
			$dbconnection = new PDO($pg_connect_str, $this->dbuser, $this->dbpass);
			$dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbconnection;
		}
	}