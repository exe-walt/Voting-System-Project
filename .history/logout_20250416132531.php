<?php
session_start(); // Start session access
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the index page (login page)
header("Location: index.html");
exit();
?>