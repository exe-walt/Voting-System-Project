<?php
session_start();

// Prevent page from being cached
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// If user isn't logged in, redirect to login page
if (!isset($_SESSION['studentID'])) {
		header("Location: index.php");
		exit();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<link rel="stylesheet" href="thankyou.css" />
	<title>Thank You Page</title>
</head>

<body>
	<!-- Thank You Image -->
	<img src="img/Vote.png" alt="Thank you for Voting" class="thank-you-image" />

	<!-- Thank You Message -->
	<p>Thank You for Voting!</p>
	<h4>Your vote has successfully been recorded.</h4>

	<!-- Logout Button -->
	<div class="logout-btn">
		<button onclick="window.location.href='logout.php'">Log Out</button>
	</div>
</body>
</html>
