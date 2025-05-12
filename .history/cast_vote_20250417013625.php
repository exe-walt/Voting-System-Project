<?php
session_start();
include("db.php"); // your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['studentID'];

    // Escape values to prevent SQL injection
    $candidateName = mysqli_real_escape_string($conn, $_POST['candidateName']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $voteTime = date("Y-m-d H:i:s");
    $nextPage = $_POST['nextPage'];

    // Check if the student has already voted for this position
    $checkSql = "SELECT * FROM votes WHERE studentID = '$studentID' AND position = '$position'";
    $checkResult = mysqli_query($conn, $checkSql);

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
            .info-box {
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
            function goNext() {
                window.location.href = '$nextPage';
            }
        </script>
        </head>
        <body>
            <div class='info-box'>
                <h2>⚠️ You have already voted for $position!</h2>
                <p>Redirecting to the next position...</p>
                <button onclick='goNext()'>Proceed</button>
            </div>
            <script>setTimeout(goNext, 3000);</script>
        </body>
        </html>
        ";
    } else {
        // Insert the vote
        $sql = "INSERT INTO votes (studentID, position, candidateName, voteTime) 
                VALUES ('$studentID', '$position', '$candidateName', '$voteTime')";

        if (mysqli_query($conn, $sql)) {
            // Determine if this is the last position (Deputy-Womens-Commissioner)
            if ($position === "Deputy Women's Commissioner") {
                $nextPage = "ThankYou.php";
            }

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
