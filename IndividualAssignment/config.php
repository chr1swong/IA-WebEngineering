<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystudykpi";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Error Connecting to the database: " . mysqli_connect_error());
}
?>