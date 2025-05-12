<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID      = $_SESSION['studentID'];
    $candidateName  = $_POST['candidateName'];
    $position       = $_POST['position'];
    $voteTime       = date('Y-m-d H:i:s');
    $nextPage       = $_POST['nextPage'];

    // Check if student has already voted for this position
    $checkStmt = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");
    $checkStmt->bind_param("ss", $studentID, $position);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Already voted
        echo "<h2>You have already voted for <strong>$position</strong>.</h2>";
        echo "<p>Redirecting to the next position...</p>";
        echo "<script>
                setTimeout(() => {
                    window.location.href='$nextPage';
                }, 3000);
              </script>";
    } else {
        // Record the vote
        $stmt = $conn->prepare("INSERT INTO votes (studentID, position, candidateName, voteTime) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $studentID, $position, $candidateName, $voteTime);

        if ($stmt->execute()) {
            // ✅ Success message with countdown redirect
            echo "<h2>✅ Your vote for <strong>$candidateName</strong> as <strong>$position</strong> has been recorded successfully!</h2>";
            echo "<p>You will be redirected to the next position in <span id='countdown'>3</span> seconds...</p>";

            // Countdown + redirect script
            echo "<script>
                    let seconds = 3;
                    const countdown = document.getElementById('countdown');
                    const timer = setInterval(() => {
                        seconds--;
                        countdown.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(timer);
                            window.location.href = '$nextPage';
                        }
                    }, 1000);
                  </script>";
        } else {
            echo "<h2>❌ Failed to record your vote. Please try again.</h2>";
        }
        $stmt->close();
    }
    $checkStmt->close();
    $conn->close();
} else {
    // Invalid direct access
    header("Location: index.php");
    exit();
}
?>
