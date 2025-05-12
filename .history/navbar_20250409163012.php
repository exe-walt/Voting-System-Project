<?php sess;
?>

<div class="nav-bar">
    <div class="logomain">
      <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
    </div>
    <div class = "profile">
      
    
    <?php if (isset($_SESSION['user'])): ?>
        <!-- If user is logged in, show profile image as the button -->
        <img src="<?php echo $_SESSION['user']['profile']; ?>" 
            id="profileImage" 
            alt="Profile" 
            style="width:40px; height:40px; border-radius:50%; cursor:pointer; margin-left:20px;"
        >
        <?php else: ?>
        <!-- Otherwise, show the default "Sign Up" button -->
        <img class="img" src="img/default.jpg" alt="student profile">
    <?php endif; ?>


      <div class="student-details">
        <div class="student-name"><?php echo $_SESSION['fullName']; ?></div>
        <div class="student-id"><?php echo $_SESSION['studentID']; ?></div>
      </div>
    </div>
  </div>