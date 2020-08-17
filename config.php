<?php
$servername = "localhost";
//$username = "vedicpar_parampara";
//$password = "1234";
$username = "root";
$password = "";
$db="vedicpar_parampara";

// Create connection
$conn =mysqli_connect($servername, $username, $password,$db);

// Check connection
if($conn === false) {
	// Handle error - notify administrator, log to a file, show an error screen, etc.
	return mysqli_connect_error();
	die("Connection failed: " . mysqli_connect_error());
}
return $conn;
?>