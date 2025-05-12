<?php
session_start();
if (!isset($_SESSION['studentID'])) {
    header("Location: login.html");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Voting System</title>
  <link rel="icon" href="/img/wiuc1wbg.png" type="image/png">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar-->
  <div class="nav-bar">
          <div class="logomain">
            <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
          </div>

          <div class="profile">
            <img class="img" src="img/walt.png" alt="student profile">
              <div class="student-details">
                <div class="student-name"><?php echo $_SESSION['name']; ?></div>
                <div class="student-id"><?php echo $_SESSION['studentID']; ?></div>
              </div>
          </div>
    </div>
