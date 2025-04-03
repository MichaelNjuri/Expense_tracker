<?php
$host = 'localhost';  // Database host
$username = 'root';   // Database username
$password = '';       // Database password
$dbname = 'expense_tracker';  // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful!";
}
?>
