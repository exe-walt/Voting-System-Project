<?php ;
?>

<div class="nav-bar">
    <div class="logomain">
      <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
    </div>
    <div class = "profile">
      <?php 
      if(isset($_SESSION
      ?>
      <img class="img" src="img/walt.png" alt="student profile">
      <div class="student-details">
        <div class="student-name"><?php echo $_SESSION['fullName']; ?></div>
        <div class="student-id"><?php echo $_SESSION['studentID']; ?></div>
      </div>
    </div>
  </div>