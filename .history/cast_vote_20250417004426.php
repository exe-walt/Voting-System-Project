<?php
session_start();
include("db_connection.php"); // your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['studentID'];
    $candidateName = $_POST['candidateName'];
    $position = $_POST['position'];
    $voteTime = date("Y-m-d H:i:s");
    $nextPage = $_POST['nextPage'];

    // Insert the vote
    $sql = "INSERT INTO votes (studentID, position, candidateName, voteTime) 
            VALUES ('$studentID', '$position', '$candidateName', '$voteTime')";

    if (mysqli_query($conn, $sql)) {
        // Success message with countdown
        echo "
        <html>
        <head>
        <title>Vote Successful</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f9f9f9;
            padding: 80px;
          }
          .success-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            display: inline-block;
          }
          h2 {
            color: #2E8B57;
            margin-bottom: 10px;
          }
          p {
            font-size: 18px;
            margin: 8px 0;
          }
          .countdown {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
          }
        </style>
        <script>
          let countdown = 3;
          function updateCountdown() {
            document.getElementById('countdown').innerHTML = countdown;
            countdown--;
            if (countdown < 0) {
              window.location.href = '$nextPage';
            } else {
              setTimeout(updateCountdown, 1000);
            }
          }
          window.onload = updateCountdown;
        </script>
        </head>
        <body>
          <div class='success-box'>
            <h2>✅ Vote Recorded Successfully!</h2>
            <p>Thank you for voting for <strong>$candidateName</strong> as <strong>$position</strong>.</p>
            <p>You will be redirected in <span id='countdown'>3</span> seconds...</p>
          </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
