<?php
	#$servername = "localhost";
	#$username = "root";
	#$password = "adm1n";
	#$database = "escuela_infantil";

	$servername = "fdb1029.awardspace.net";
	$username = "4496204_mjfei";
	$password = "mjf12345.";
	$database = "4496204_mjfei";


	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); 	 	 	 	 	 	
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
	}catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
?>