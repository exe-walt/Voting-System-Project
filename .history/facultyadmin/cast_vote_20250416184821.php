<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_SESSION['studentID'];
    $position = $_POST['position'];
    $candidateName = $_POST['candidateName'];

    // Check if this user already voted for this position
    $checkVote = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");
    $checkVote->bind_param("ss", $studentID, $position);
    $checkVote->execute();
    $result = $checkVote->get_result();

    if ($result->num_rows > 0) {
        echo "You have already voted for this position. <a href='{$position}.php'>Go back</a>";
        exit();
    }

    // Insert the vote
    $insertVote = $conn->prepare("INSERT INTO votes (studentID, position, candidateName) VALUES (?, ?, ?)");
    $insertVote->bind_param("sss", $studentID, $position, $candidateName);

    if ($insertVote->execute()) {
        // Redirect to next page or confirmation
        echo "Vote successfully cast for $candidateName in $position. <a href='{$position}.php'>Go back</a>";
    } else {
        echo "Error: Could not record vote. Please try again.";
    }

    $checkVote->close();
    $insertVote->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
