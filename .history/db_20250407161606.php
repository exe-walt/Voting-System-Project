<?php
// Database connection details
$host = "localhost";
$user = "root";
$password = "";
define('DB_NAME', 'onlinevoting');
$database = DB_NAME;

// Create connection
$conn = new mysqli("p:" . $host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: {$conn->connect_error}");
    echo "We are experiencing technical difficulties. Please try again later.";
}
?>
