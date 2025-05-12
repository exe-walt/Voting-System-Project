<?php 

  include("connect.php");

  if(isset($_POST["Loginbtn"])){
    $studentID = $_POST["studentID"];
    $studentPin = $_POST["studentPin"];

    $checkstudentID = $conn->prepare("SELECT * FROM `login` WHERE studentID = ?");
    $checkstudentID->bind_param("s", $studentID);
    $checkstudentID->execute();
    $result = $checkstudentID->get_result();
  }
?>