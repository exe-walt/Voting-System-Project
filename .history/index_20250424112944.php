<?php
// Enforce HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $redirectUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $redirectUrl);
    exit();
}

// Set secure session cookie parameters (make sure this is before session_start())
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

// Check if the user has already voted for a role
if (isset($_SESSION['hasVoted']) && $_SESSION['hasVoted'] == true) {
    echo "<script>alert('You have already voted for all available positions.');</script>";
    unset($_SESSION['hasVoted']); // Clear the session variable after showing the alert
}

// Check if there's a message about voting
if (isset($_SESSION['voteMessage'])) {
    echo "<script>alert('" . $_SESSION['voteMessage'] . "');</script>";
    unset($_SESSION['voteMessage']); // Clear the session message after showing the alert
}

// Logout functionality to reset session when the user logs out
if (isset($_GET['logout'])) {
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to main login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <title>Wisconsin E-voting</title>
  <link rel="icon" href="img/wiuc1wbg.png" type="image/png">
  <link rel="stylesheet" href="login.css">
</head>
<body>
  
  <!-- Login card -->
  <div class="login-card">
    <div class="wiuc-img">
      <img src="img/wiuc1wbg.png" alt="wiuclogo" class="logo" hre>
    </div>
    
    <p>Welcome to our e-voting portal</p>
    
    <!-- Form now points to login.php -->
    <form action="login.php" method="post" autocomplete="off">
      <div class="login-container">
        <div class="student-id">
          <label for="studentID">Student ID:</label>
          <input type="text" placeholder="Enter your student ID" required id="studentID" name="studentID" autocomplete="off">
        </div>
        <div class="student-pin">
          <label for="studentPin">Pin:</label>
          <input type="password" placeholder="Enter your Pin" required id="studentPin" name="studentPin" autocomplete="off">
        </div>

        <!-- The submit button is inside the form -->
        <button type="submit" class="login-btn" name="loginBtn">Login</button>
      </div>
    </form>
  </div>
</body>
</html>
