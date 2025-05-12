<?php 
session_start(); 
require_once 'db.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    $studentID      = $_SESSION['studentID'];     
    $candidateName  = $_POST['candidateName'];     
    $position       = $_POST['position'];     
    $voteTime       = date('Y-m-d H:i:s');     
    $nextPage       = $_POST['nextPage'];  

    // Check if student already voted for this position     
    $checkStmt = $conn->prepare("SELECT * FROM votes WHERE studentID = ? AND position = ?");     
    $checkStmt->bind_param("ss", $studentID, $position);     
    $checkStmt->execute();     
    $result = $checkStmt->get_result();  

    if ($result->num_rows > 0) {         
        echo "<h3>You have already voted for $position.</h3>";         
        echo "<a href='$nextPage'>Proceed</a>";     
    } else {         
        $stmt = $conn->prepare("INSERT INTO votes (studentID, position, candidateName, voteTime) VALUES (?, ?, ?, ?)");         
        $stmt->bind_param("ssss", $studentID, $position, $candidateName, $voteTime);  

        if ($stmt->execute()) {             
            echo "
            <div class='success-popup'>
                <h2>Vote Recorded Successfully!</h2>
                <p>Your vote for <strong>$position</strong> has been recorded successfully.</p>
                <p>Redirecting to the next position...</p>
                <div class='countdown' id='countdown'>3</div>
                <button onclick='window.location.href=\"$nextPage\"'>Proceed to Next Position</button>
            </div>
            <script>
                var countdown = 3;
                var countdownElement = document.getElementById('countdown');
                var interval = setInterval(function() {
                    countdown--;
                    countdownElement.innerText = countdown;
                    if (countdown <= 0) {
                        clearInterval(interval);
                        window.location.href = '$nextPage';
                    }
                }, 1000);
            </script>
            ";
        } else {             
            echo "Failed to record vote.";         
        }         
        $stmt->close();     
    }     
    $checkStmt->close();     
    $conn->close(); 
} else {     
    header("Location: index.php");     
    exit(); 
}
?>

