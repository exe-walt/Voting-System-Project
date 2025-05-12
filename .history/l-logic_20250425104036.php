<?php
session_start();

// Connect to your database
$servername = "localhost";
$username = "root"; 
$password = "";
$database = "onlinevoting";
$port = "3307";

// Create connection with port specified
$conn = new mysqli($servername, $username, $password, $database, port: (int)$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$email = mysqli_real_escape_string($conn, $_POST['email']);
$passwordInput = mysqli_real_escape_string($conn, $_POST['password']);

// Use prepared statements to fetch user securely
$sql = "SELECT * FROM `dash_login` WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify hashed password
    if (password_verify($passwordInput, $row['password'])) {
        // Start user session securely
        $_SESSION['fullName'] = $row['fullName'];
        $_SESSION['email'] = $row['email'];
        session_regenerate_id(true); // prevent session fixation

        // Redirect to dashboard
        header("Location: facultyadmin/dashboard.php");
        exit();
    } else {
        // Password incorrect
        header("Location: dash-login.php?error=invalid_password");
        exit();
    }
} else {
    // Email not found
    header("Location: dash-login.php?error=user_not_found");
    exit();
}

$conn->close();
?>
