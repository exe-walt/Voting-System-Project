<?php
session_start();

// Connect to the 'onlinevoting' database
$servername = "localhost"; // Update this value to the hostname of your database server (e.g., '127.0.0.1' or a remote server address)
$username = "root"; // Change to your DB username
$password = "";     // Change to your DB password
$dbname = "onlinevoting";
$port="3307";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, port: $port);
$conn = new mysqli($servername, $username, $password, $dbname, port: $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user inputs
     $studentID = htmlspecialchars(trim($_POST['studentID']), ENT_QUOTES, 'UTF-8');
    $studentPin = trim($_POST['studentPin']);

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT studentID, studentPin, name FROM login WHERE studentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verify hashed PIN
    if (password_verify($studentPin, $user['studentPin'])) {
        $_SESSION['studentID'] = $user['studentID'];
        $_SESSION['name'] = $user['name'];
        header("Location: President.php");
        exit();
    } else {
        echo htmlspecialchars("Incorrect PIN. Please try again. <a href='login.html'>Go back</a>", ENT_QUOTES, 'UTF-8');
    }
    } else {
        echo htmlspecialchars("Student ID not found. Please try again. <a href='login.html'>Go back</a>", ENT_QUOTES, 'UTF-8');
}

    $stmt->close();
} else {
    header("Location: login.html");
    header("Location: login.html", true, 302);
}
?>
