<?php 

	require_once('config.php');
	
	## DATABASE

	if (($_SERVER['SERVER_ADDR'] == "127.0.0.1") OR ($_SERVER['SERVER_ADDR'] == "::1"))
	{
		// home / development environment
		$host = 'localhost';
		$db = 'uabt'; 
		$baseURL = 'http://localhost/';
		//$user = 'root';
		//$password = '123';
		$user = 'Vbeta1';
		$password = 'hhhhh';
	}
	else 
	{
		// server / web host
		$host = 'localhost';
		$db = 'uabt';
		$baseURL = $siteURL.'/'; //creer la variable siteURL dans le fichier config.php
		$user = 'user';
		$password = 'pass';
	}

	// se connecter a la BDD
	if (!isset($conn )) $conn = mysql_connect($host, $user, $password) OR die("<h1>Erreure de connection a la BDD. ".mysql_error()."</h1>");

	// configuration des caracteres
	//mysql_set_charset('utf8',$conn); // activer pour les anciennes versions de PHP/MySQL
	mysql_query("
		SET NAMES 'utf8',
		SET character_set_results = 'utf8', 
		character_set_client = 'utf8', 
		character_set_connection = 'utf8', 
		character_set_database = 'utf8', 
		character_set_server = 'utf8'", 
		$conn);
	
	// selectionner la BDD
	mysql_select_db($db, $conn) or die("<h2>Impossible de selectionner la BDD ".$db."</h2><p>".mysql_error()."</p>");

?>