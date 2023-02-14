<?php
	$host = "localhost";
	$user = "associ89_granado";
	$pass = "741252dra";
	$db   = "associ89_granado";
	
	$conn = new MySQLi($host, $user, $pass, $db);
	
	if(mysqli_connect_errno())
		trigger_error(mysqli_connect_error());
	
?>