<?php

	class Dbh {

		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "id12999633_apoc";
		private $port = "3308";

		protected function connect(){
			
			$dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->dbname . ';port=' . $this->port;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		}

	}

?>