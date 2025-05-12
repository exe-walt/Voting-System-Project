<?php
session_start();
require_once 'db.php'; // include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user inputs
    $studentID = trim($_POST['studentID']);
    $studentPin = trim($_POST['studentPin']);

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE studentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify hashed PIN from database (assumes the column name is exactly 'studentPin')
        if ($studentPin == row$user['studentPin'])) {
            // Set session variables for authenticated user
            $_SESSION['studentID'] = $user['studentID'];
            $_SESSION['name'] = $user['name']; //fullName
            
            // Redirect to the protected President page
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
    // If the page is accessed without POST data, redirect to login page
    header("Location: login.html");
    exit();
}
?>
