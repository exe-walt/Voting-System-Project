<?php
session_start();
include("db.php");

// Check if the user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['studentID'];
    $candidateName = $_POST['candidateName'];
    $position = $_POST['position'];

    // Prevent double voting for the same position
    $checkVote = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");
    $checkVote->bind_param("ss", $studentID, $position);
    $checkVote->execute();
    $result = $checkVote->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('You have already voted for this position!');
            window.location.href='General-Secretary.php';
        </script>";
        exit();
    }

    // Record the vote
    $stmt = $conn->prepare("INSERT INTO votes (studentID, position, candidateName) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $studentID, $position, $candidateName);

    if ($stmt->execute()) {
        // Success message with countdown and redirect
        echo "
        <html>
        <head>
            <title>Vote Successful</title>
            <meta http-equiv='refresh' content='3;url=General-Secretary.php'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                    background-color: #f9f9f9;
                }
                .message-box {
                    display: inline-block;
                    padding: 30px;
                    background: #fff;
                    border: 2px solid #28a745;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .message-box h1 {
                    color: #28a745;
                    margin-bottom: 20px;
                }
                .countdown {
                    font-size: 18px;
                    margin-top: 10px;
                }
            </style>
            <script>
                let seconds = 3;
                function countdown() {
                    seconds--;
                    document.getElementById('countdown').innerHTML = seconds;
                    if (seconds <= 0) {
                        clearInterval(timer);
                    }
                }
                let timer = setInterval(countdown, 1000);
            </script>
        </head>
        <body>
            <div class='message-box'>
                <h1>Vote recorded successfully!</h1>
                <p>You will be redirected to the next page in <span id='countdown'>3</span> seconds.</p>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>



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
