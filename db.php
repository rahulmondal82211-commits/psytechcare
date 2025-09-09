<?php
$host = "localhost";   // Database host
$user = "root";        // Default user in XAMPP
$pass = "";            // Default password is empty
$dbname = "psytechcare"; // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
