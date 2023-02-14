<?php
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "associ89_granado";
	
	$conn = new MySQLi($host, $user, $pass, $db);
	
	$conn -> set_charset("utf8");

	if(mysqli_connect_errno())trigger_error(mysqli_connect_error());
?>