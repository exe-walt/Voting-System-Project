<?php
session_start();

// Connect to the 'onlinevoting' database
$servername = "localhost"; // Change if hosted elsewhere
$username = "root"; // Change to your DB username
$password = "";     // Change to your DB password
$dbname = "onlinevoting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user inputs
    $studentID = htmlspecialchars(trim($_POST['studentID']), ENT_QUOTES, 'UTF-8');
    $studentPin = trim($_POST['studentPin']);

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE studentID = ?");
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
            echo "Incorrect PIN. <a href='login.html'>Try again</a>";
        }
    } else {
        echo "Student ID not found. <a href='login.html'>Try again</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>
