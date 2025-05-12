<?php 

  include("connect.php");

  // Check if the login button was clicked
  if(isset($_POST["loginBtn"])){
    $studentID = filter_input(INPUT_POST, 'studentID', FILTER_SANITIZE_STRING);
    $studentPin = htmlspecialchars($_POST["studentPin"], ENT_QUOTES, 'UTF-8');

    $checkstudentID = $conn->prepare("SELECT * FROM `login` WHERE studentID = ? LIMIT 1");
    $checkstudentID->bind_param("s", $studentID);
    $checkstudentID->execute();
    $result = $checkstudentID->get_result();
    
    if ($result && $result->num_rows > 0) {
        // Process the result if a matching record is found
        echo "Login successful.";
    } else {
        // Handle the case where no matching record is found or query fails
        echo "Invalid student ID or PIN.";
    }
  }
?>