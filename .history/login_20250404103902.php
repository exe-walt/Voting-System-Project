<?php 

  include("connect.php");

  if(isset($_POST["Loginbtn"])){
    $studentID = $_POST["studentID"];
    $studentPin = $_POST["studentPin"];

    $checkstudentID = "SELECT * From 'login"
?>