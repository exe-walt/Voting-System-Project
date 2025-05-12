<?php 

  include("connect.php");

  if(isset($_POST["Loginbtn"])){
    $studentID = $_POST["studentID"];
    $studentPin = $_POST["studentPin"];

    $checkstudentID = "SELECT * FROM `login` WHERE studentID='$studentID'";
    $result = $conn->query($checkstudentID);
  }
?>