<?php

	define("server","localhost");
	define("username","root");
	define("password","");
	define("database","parish_database");
	
	$connect=mysqli_connect(server,username,password,database);
	$select_db=mysqli_select_db($connect,database);
	if(!$connect || !$select_db){die('unable to connect');}
	
	
?>