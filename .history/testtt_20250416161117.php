<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID = trim($_POST['studentID']);
    $studentPin = trim($_POST['studentPin']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE studentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed PIN
        if (password_verify($studentPin, $user['studentPin'])) {
            $_SESSION['studentID'] = $user['studentID'];
            $_SESSION['fullName'] = $user['fullName'];

            header("Location: President.php");
            exit();
        } else {
            echo "Incorrect PIN. <a href='index.php'>Try again</a>";
        }
    } else {
        echo "Student ID not found. <a href='index.php'>Try again</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
