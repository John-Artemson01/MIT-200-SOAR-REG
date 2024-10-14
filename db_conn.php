<?php
// Database connection parameters
$host = "localhost";          // Database host
$username = "root";           // Database username
$password = "";               // Database password
$database = "student_registration"; // Database name

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
