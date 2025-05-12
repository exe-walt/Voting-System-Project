<?php
session_start();
require_once 'db.php'; // include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user inputs
    $studentID = trim($_POST['studentID']);
    $studentPin = trim($_POST['studentPin']);

    // Prepare SQL to check if Student ID exists
    $stmt = $conn->prepare("SELECT * FROM login WHERE studentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ✅ Validate studentID and studentPin combination
        if ($studentID == $user['studentID'] && $studentPin == $user['studentPin']) {
            
            // ✅ Check if this student has already voted (using studentID and studentPin)
            $voteCheck = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND studentPin = ?");
            $voteCheck->bind_param("ss", $studentID, $studentPin);
            $voteCheck->execute();
            $voteResult = $voteCheck->get_result();

            if ($voteResult->num_rows > 0) {
                // 🚫 Already voted — alert and redirect to index
                echo "<script>alert('You have already voted and cannot login again.'); window.location.href='index.php';</script>";
                exit();
            } else {
                // ✅ Set session variables for authenticated user
                $_SESSION['studentID'] = $user['studentID'];
                $_SESSION['fullName']  = $user['fullName']; // fullName from database

                // ✅ Also store extra user details if needed
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['studentID'],
                    'profile'  => $user['profile'] // path to the profile image
                ];

                // ✅ Redirect to the protected President page
                header("Location: President.php");
                exit();
            }
        } else {
            // ❌ Incorrect PIN — alert and go back
            echo "Incorrect PIN. <a href='index.php'>Try again</a>";
        }
    } else {
        // ❌ Student ID not found — alert and go back
        echo "Student ID not found. <a href='index.php'>Try again</a>";
    }

    // ✅ Clean up
    $stmt->close();
    $conn->close();

} else {
    // If the page is accessed without POST data, redirect to login page
    header("Location: index.php");
    exit();
}
?>
