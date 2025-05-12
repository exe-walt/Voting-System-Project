<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "onlinevoting";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentID = $_POST['studentID'];
$studentPin = $_POST['studentPin '];

// Prepare SQL to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE studentID = ?");
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify hashed PIN
    if (password_verify($studentPin , $user['studentPin '])) {
        // Set session variables
        $_SESSION['studentID'] = $user['studentID'];
        $_SESSION['name'] = $user['name'];
        
        // Redirect to dashboard
        header("Location: preseident");
        exit();
    } else {
        echo "Invalid PIN. <a href='login.html'>Try again</a>";
    }
} else {
    echo "ID Number not found. <a href='login.html'>Try again</a>";
}

$stmt->close();
$conn->close();
?>
