<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "onlinevoting";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_number = $_POST['id_number'];
$pin = $_POST['pin'];

// Prepare SQL to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE id_number = ?");
$stmt->bind_param("s", $id_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify hashed PIN
    if (password_verify($pin, $user['pin'])) {
        // Set session variables
        $_SESSION['id_number'] = $user['id_number'];
        $_SESSION['name'] = $user['name'];
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid PIN. <a href='login.html'>Try again</a>";
    }
} else {
    echo "ID Number not found. <a href='login.html'>Try again</a>";
}

$stmt->close();
$conn->close();
?>
