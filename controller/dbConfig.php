<?php 
	
	$serverName = "localhost";
	$userName = "root";
	$password = "robisearch2018";
	$databaseName = "libsystem";

	//mysql_connect($serverName, $userName, $password) or die(mysql_error());
	//mysql_select_db($databaseName) or die(mysql_error());
	$con = mysqli_connect($serverName, $userName, $password, $databaseName);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
?>