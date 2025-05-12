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

<!-- Inline CSS -->
<style>
/* Apply Tenorite font to all elements */
* {
    font-family: 'Tenorite', sans-serif;
}

/* Base Styles */
body {
    font-family: 'Tenorite', sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Success Popup Box */
.success-popup {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 400px;
    padding: 20px;
    text-align: center;
    font-size: 18px;
    color: #333;
}

.success-popup h2 {
    font-size: 24px;
    color: #4CAF50;
}

.success-popup p {
    margin: 20px 0;
    font-size: 16px;
}

.success-popup .countdown {
    font-size: 30px;
    font-weight: bold;
    color: #FF5722;
    margin: 10px 0;
}

.success-popup button {
    background-color: #4CAF50;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    border-radius: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

.success-popup button:hover {
    background-color: #45a049;
}

/* Centering the content */
#content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
</style>
