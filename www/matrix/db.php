<?php
	// Change this to your connection info.
	$DATABASE_HOST = '172.18.0.2:3306';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'password';
	$DATABASE_NAME = 'id12999633_apoc';
	$DATABASE_CHARSET = 'charset=utf8';
	//mysql_query("set names 'utf8'");
	// Try and connect using the info above.
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Falha ao conectar ao servidor MySQL: ' . mysqli_connect_error().'Arquivo: db.php');
	}


	
?>
