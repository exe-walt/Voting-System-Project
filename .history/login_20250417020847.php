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
        if ($studentID == $user['studentID'] && $studentPin == $user['studentPin']) {
             $_SESSION['user'] = [
                'id'       => $row['id'],
                'username' => $row['studentID'],
                'profile'  => $row['profile']  // path to the profile image
            ];

            // Set session variables for authenticated user
            $_SESSION['studentID'] = $user['studentID'];
            $_SESSION['fullName'] = $user['fullName']; //fullName
            
            // Redirect to the protected President page
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
    // If the page is accessed without POST data, redirect to login page
    header("Location: index.php");
    exit();
}
?>




<?php
session_start();
require_once 'db.php'; // include the database connection
// Enforce HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $redirectUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $redirectUrl);
    exit();
}

// Set secure session cookie parameters
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
include("db.php"); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
    $studentPin = mysqli_real_escape_string($conn, $_POST['studentPin']);

    // Check if the student has already voted
    $checkVoteQuery = "SELECT * FROM votes WHERE studentID = '$studentID'";
    $result = mysqli_query($conn, $checkVoteQuery);

    if (mysqli_num_rows($result) > 0) {
        // User has already voted, alert them and set a session variable
        $_SESSION['voted'] = true;
        header("Location: index.php"); // Redirect back to the main page
        exit();
    } else {
        // User hasn't voted, proceed with the login
        $loginQuery = "SELECT * FROM students WHERE studentID = '$studentID' AND studentPin = '$studentPin'";
        $loginResult = mysqli_query($conn, $loginQuery);

        if (mysqli_num_rows($loginResult) > 0) {
            // User found, login successful
            $_SESSION['studentID'] = $studentID;
            header("Location: vote.php"); // Redirect to the voting page
            exit();
        } else {
            // Invalid login
            echo "Invalid Student ID or Pin!";
        }
    }
}
?>
