<?php
	$database_username = 'root';
	$database_password = 'lafureur77@@';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=resto_app', $database_username, $database_password );
	$conn = new mysqli("localhost", "root", "lafureur77@@", "resto_app");
		
?>