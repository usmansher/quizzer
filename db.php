<?php
	// Create Connection Credentials
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'uoms786';
	$db_name = 'quizzer';

	// Create mysqli object
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

	// Error Handler
	if ($mysqli->connect_error) {
		printf("Connection Failed %s\n". $mysqli->connect_error);
		exit();
	}
?>