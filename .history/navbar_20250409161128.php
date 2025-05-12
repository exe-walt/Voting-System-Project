<?php ;
?>

<div class="nav-bar">
    <div class="logomain">
      <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
    </div>
    <div class = "profile">
      <?php 
      if(isset($_SESSION['user'])):?>
      <img src="includes/<?php echo $_SESSION['user']['profile']; ?>" alt="Profile Image" style="width:100px; height:100px; border-radius:50%;">
      <div class="student-details">
        <div class="student-name"><?php echo $_SESSION['fullName']; ?></div>
        <div class="student-id"><?php echo $_SESSION['studentID']; ?></div>
      </div>
    </div>
  </div>