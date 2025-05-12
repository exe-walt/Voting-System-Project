<?php 

  include("connect.php");

  if(isset($_POST["Loginbtn"])){
    $studentID = filter_input(INPUT_POST, 'studentID', FILTER_SANITIZE_STRING);
    $studentPin = htmlspecialchars($_POST["studentPin"], ENT_QUOTES, 'UTF-8');

    $checkstudentID = $conn->prepare("SELECT * FROM `login` WHERE studentID = ?");
    $checkstudentID->bind_param("s", $studentID);
    $checkstudentID->execute();
    $result = $checkstudentID->get_result();
  }
?>