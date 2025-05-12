<?php
session_start();
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: index.php");
    exit();
}

// Check if vote data was sent
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['candidateID'], $_POST['position'])) {
    $studentID   = $_SESSION['studentID'];
    $candidateID = $_POST['candidateID'];
    $position    = $_POST['position'];

    // Prevent double voting for the same position
    $checkQuery = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");
    $checkQuery->bind_param("ss", $studentID, $position);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        echo "
            <div style='text-align:center; font-family:sans-serif; padding:20px;'>
                <h2>⚠️ You’ve already voted for <strong>$position</strong>!</h2>
                <a href='General-Secretary.php'>
                    <button style='padding: 10px 20px; margin-top: 20px;'>Proceed to General Secretary</button>
                </a>
            </div>
        ";
        exit();
    }

    // Record the vote
    $stmt = $conn->prepare("INSERT INTO votes (studentID, candidateID, position) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $studentID, $candidateID, $position);

    if ($stmt->execute()) {
        echo "
            <div style='text-align:center; font-family:sans-serif; padding:20px;'>
                <h2>✅ Your vote for <strong>$candidateID</strong> as <strong>$position</strong> has been recorded successfully!</h2>
                <p>Redirecting to the next position in <span id='countdown'>3</span> seconds...</p>
                <script>
                    var seconds = 3;
                    var countdown = setInterval(function() {
                        seconds--;
                        document.getElementById('countdown').textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(countdown);
                            window.location.href = 'General-Secretary.php';
                        }
                    }, 1000);
                </script>
            </div>
        ";
    } else {
        echo "Error recording vote: " . $stmt->error;
    }

    $stmt->close();
    $checkQuery->close();
    $conn->close();

} else {
    header("Location: President.php");
    exit();
}
?>
