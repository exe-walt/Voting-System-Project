<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>President Voting Page</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="img/wiuc1wbg.png">
</head>
<body>
  <!-- Example Navbar or Content
  <div class="nav-bar">
    <div class="logomain">
      <img class="logo" src="img/wiuclogofull.png" alt="WIUC Logo"/>
    </div>
    <div class="profile">
      <img class="img" src="img/walt.png" alt="student profile">
      <div class="student-details">
        <div class="student-name"><?php// echo $_SESSION['fullName']; ?></div>
        <div class="student-id"><?php //echo $_SESSION['studentID']; ?></div>
      </div>
    </div>
  </div> 
   -->
  <!-- Page Content -->
    <div class="content">
      <div class="content-container">
        <div class="left-container">
          <div class="vote-txt">
            <p>VOTE FOR</p>
          </div>
          <div class="roles-container">
            <!-- President -->
            <a href="President.html" class="president-link">
              <div class="div-president">
                <div class="president">President</div>
              </div>
            </a>
            
            
            <!-- General Secretary -->
             <a href="General-Secretary.html" class="genSec-link">
              <div class="div-genSec">
                <div class="gen-secretary">General Secretary</div>
              </div>
             </a>
            
            <!-- External Affairs President -->
             <a href="External-Affairs-President.html" class="extAff-link">
              <div class="div-externalaffairs">
                <div class="ext-affairs">External Affairs President</div>
              </div>
             </a>
            

            <!-- Financial Controller -->
             <a href="Financial-Controller.html" class="finCont-link">
              <div class="div-fincont">
                <div class="main-financial">Financial Controller</div>
              </div>
             </a>
            

            <!-- Main Women's Commissioner -->
             <a href="Womens-Commissioner.html" class="wcom-link">
              <div class="div-wcom">
                <div class="main-wcom">Women’s Commissioner</div>
              </div>
             </a>
            

            <!-- Deputy Women's Commissioner -->
             <a href="Deputy-Womens-Commissioner.html" class="deptwcom-link">
              <div class="div-deptwcom">
                <div class="dept-wcom">Deputy Women’s Commissioner</div>
              </div>
             </a>
            
          </div>
        </div>

    <!--right container will come here-->
      <div class="card-right">
        <p>Candidates</p>

        <div class="cards-container">
            <div class="studentCard-details">
            
            <div class="candidate-profile">
              <img src="img/invincible.jpg" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">John Doe</div>
              <div class="candidate-role">Chairman</div>
            </div>

            <button class="vote-btn">Vote</button>
          </div>

          <!-- Candidate 2 -->
          <div class="studentCard2-details">
            
            <div class="candidate-profile">
              <img src="img/eve.jpg" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">Jane Doe</div>
              <div class="candidate-role">Nobody</div>
            </div>

            <button class="vote-btn">Vote</button>
          </div>
          <!--end of candidate 2-->
        </div>
      </div>
    </div>
  </div>
  
  <a href="General-Secretary.html" class="nextbtn-link">
    <button type="button" class="nextbtn">NEXT</button>
  </a>
  
</body>
</html>