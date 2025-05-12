<?php
session_start();
include("db_connection.php"); // Your DB connection file

// Check if the user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['studentID']; // From session
    $candidateName = $_POST['candidateName']; // Candidate name passed from the form
    $position = $_POST['position']; // Role or position (e.g. 'President')

    // Prevent double voting for the same position
    $checkVote = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");
    $checkVote->bind_param("ss", $studentID, $position);
    $checkVote->execute();
    $result = $checkVote->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('You have already voted for this position!'); window.location.href='General-Secretary.php';</script>";
        exit();
    }

    // Record the vote
    $stmt = $conn->prepare("INSERT INTO votes (studentID, position, candidateName) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $studentID, $position, $candidateName);

    if ($stmt->execute()) {
        echo "<script>alert('Vote recorded successfully!'); window.location.href='General-Secretary.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
