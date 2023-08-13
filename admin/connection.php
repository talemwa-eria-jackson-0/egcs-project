<?php

/* -----------------------------------------------------------------------------|
|  This is a database connection file.											|
|  You have to call this file every time you want to access your database.		|
|  You can easily do this by creating a session.php file and call it in it.  	|
|  Then you call session.php in the main header.								|
|  You then include the header.php file in all your files.						|
|																	        	|
-------------------------------------------------------------------------------*/

// Create the database connection variables

$hostname = 'localhost';			// Hostname
$database = 'egcs';					// Database name
$username = 'root';					// Database Username
$password = '';						// Database password

//Establish connection with the server
$db = new mysqli($hostname, $username, $password, $database);
?>