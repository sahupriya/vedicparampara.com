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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";
?>