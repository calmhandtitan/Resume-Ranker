<?php 
	//Connect to mysql server
	$link = mysql_connect('localhost', 'root', '');

	//Check link to the mysql server
	if(!$link)
	{
		die('Failed to connect to server: ' . mysql_error());
	}

	//Select database
	$db = mysql_select_db('resumeranker');
	if(!$db)
	{
		die("Unable to select database");
	}
 ?>