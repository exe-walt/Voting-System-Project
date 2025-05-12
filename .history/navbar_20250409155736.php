<?php session_start();
?>

<div class="nav-bar">
    <div class="logomain">
      <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
    </div>
    <div class = "profile">
      <img class="img" src="img/walt.png" alt="student profile">
      <div class="student-details">
        <div class="student-name"><?php echo $_SESSION['fullName']; ?></div>
        <div class="student-id"><?php echo $_SESSION['studentID']; ?></div>
      </div>
    </div>
  </div>