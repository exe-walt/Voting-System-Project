<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location: facultyadmin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dash-login.css">
  <title>Dashboard Login</title>
  <link rel="icon" href="img/wiuc1wbg.png" type="image/png">
</head>
<body>
  <div class="card">
      <form action="l-logic.php" method="post">
    <img src="img/wiuc1wbg.png" alt="logo">
    <div class="dash-txt">
      <p>Dashboard Panel</p>
    </div>
 
    <div class="email">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Enter your email" required>
    </div>

    <div class="password">
      <label for="password" class="pass-txt">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>

    <button type="submit">Log In</button>
  </form>
  </div>

</body>
</html>

C:\xampp\htdocs\Online-Voting-System\