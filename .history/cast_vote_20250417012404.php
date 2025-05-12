<?php
session_start();
include("db.php"); // your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['studentID'];
    $candidateName = mysqli_real_escape_string($conn, $_POST['candidateName']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $voteTime = date("Y-m-d H:i:s");
    $nextPage = $_POST['nextPage'];

    // Check if the student has already voted for this position
    $checkQuery = "SELECT * FROM votes WHERE studentID = '$studentID' AND position = '$position'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Already voted
        echo "
        <html>
        <head>
        <title>Already Voted</title>
        <style>
            body {
                font-family: 'Tenorite', sans-serif;
                text-align: center;
                background: #f4f7fa;
                padding: 80px;
            }
            .error-box {
                background: #ffffff;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: inline-block;
                max-width: 400px;
                width: 100%;
            }
            h2 {
                color: #f44336;
                margin-bottom: 20px;
            }
            p {
                font-size: 18px;
                margin: 8px 0;
            }
            button {
                background-color: #0A1F78;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                border-radius: 15px;
                cursor: pointer;
                margin-top: 20px;
                transition: background-color 0.3s ease;
            }
            button:hover {
                background-color: #00b7ff;
            }
        </style>
        </head>
        <body>
            <div class='error-box'>
                <h2>⚠️ Vote Already Cast!</h2>
                <p>You have already voted for <strong>$position</strong>.</p>
                <button onclick='window.location.href=\"$nextPage\"'>Proceed</button>
            </div>
        </body>
        </html>
        ";
    } else {
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
                    font-family: 'Tenorite', sans-serif;
                    text-align: center;
                    background: #f4f7fa;
                    padding: 80px;
                }
                .success-box {
                    background: #ffffff;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                    display: inline-block;
                    max-width: 400px;
                    width: 100%;
                }
                h2 {
                    color: #4CAF50;
                    margin-bottom: 20px;
                }
                p {
                    font-size: 18px;
                    margin: 8px 0;
                }
                .countdown {
                    font-size: 30px;
                    font-weight: bold;
                    color: #FF5722;
                    margin-top: 20px;
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    font-size: 16px;
                    border-radius: 15px;
                    cursor: pointer;
                    margin-top: 20px;
                    transition: background-color 0.3s ease;
                }
                button:hover {
                    background-color: #45a049;
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
                    <button onclick='window.location.href=\"$nextPage\"'>Proceed</button>
                </div>
            </body>
            </html>
            ";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
