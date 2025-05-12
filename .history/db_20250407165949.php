<?php
// Database connection details
$host = "localhost";
$user = "root";
$password = "";
define('DB_NAME', 'onlinevoting');
$database = DB_NAME;

// Create connection
$conn = new mysqli(hostname: "p:{$host}", username: $user, $password, database: $database);

// Check if the connection failed and handle the error
if ($conn->connect_error) {
    // Log the error message for debugging purposes
    error_log("Connection failed: {$conn->connect_error}");
    // Display a user-friendly message to the client
    echo "We are experiencing technical difficulties. Please try again later.";
}
?>