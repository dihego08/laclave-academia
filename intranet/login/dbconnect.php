<?php
    /*include("config/database.php");
     $conn = mysqli_connect(_DB_HOST,_DB_USER,_DB_PASS,_DB_NAME);*/
    //error_reporting(~E_DEPRECATED & ~E_NOTICE);


	define('DBHOST', 'localhost');
	define('DBUSER', 'u622044135_laclave');
	define('DBPASS', '8+d>K&=|NYK');
	/*define('_DB_USER', 'laclave_se');
	define('_DB_PASS', 'laclave_se');*/
	define('DBNAME', 'u622044135_laclave');
	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
	if (mysqli_connect_errno()){
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}