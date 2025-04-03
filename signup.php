<?php
// Start output buffering before anything else
ob_start();
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = isset($_POST['age']) ? (int) $_POST['age'] : NULL; // age is optional
    $password = $_POST['password'];

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
   // Update with the correct password for root
$conn = new mysqli('localhost', 'root', 'your_password', 'expense_tracker');



    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, age, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("ssis", $name, $email, $age, $hashed_password);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header('Location: login.html');
        exit();
    } else {
        echo "Error: " . $stmt->error; // Display any errors from the prepared statement
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// End output buffering
ob_end_flush();
?>
