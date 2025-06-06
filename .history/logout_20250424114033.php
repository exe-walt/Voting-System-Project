<?php
session_start();
session_unset();     // Unset all session variables
session_destroy();   // Destroy the session

// Prevent caching the logout page itself
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to index page
header("Location: index.php");
exit();
?>
#