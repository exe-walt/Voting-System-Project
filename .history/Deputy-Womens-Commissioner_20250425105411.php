<?php
session_start();

// If the studentID session isn’t set, kick them back to the login page
if (!isset($_SESSION['studentID'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Voting System</title>
  <link rel="icon" href="img/wiuc1wbg.png" type="image/png">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<?php 
include("navbar.php");
?>

    <hr class="line"/>
    <!-- End of Navbar -->

    <div class="content">
      <div class="content-container">
        <div class="left-container">
          <div class="vote-txt">
            <p>VOTE FOR</p>
          </div>
          <div class="roles-container">
            <!-- President -->
             <a href="President.php" class="president-link">
              <div class="div-president">
                <div class="president">President</div>
              </div>
             </a>
            
            
            <!-- General Secretary -->
             <a href="General-Secretary.php" class="genSec-link">
              <div class="div-genSec">
                <div class="gen-secretary">General Secretary</div>
              </div>
             </a>
            
            <!-- External Affairs President -->
             <a href="External-Affairs-President.php" class="extAff-link">
              <div class="div-externalaffairs">
                <div class="ext-affairs">External Affairs President</div>
              </div>
             </a>
            

            <!-- Financial Controller -->
             <a href="Financial-Controller.php" class="finCont-link">
              <div class="div-fincont">
                <div class="main-financial">Financial Controller</div>
              </div>
             </a>
            

            <!-- Main Women's Commissioner -->
             <a href="Womens-Commissioner.php" class="wcom-link">
              <div class="div-wcom">
                <div class="main-wcom">Women's Commissioner</div>
              </div>
             </a>
            

            <!-- Deputy Women's Commissioner -->
             <a href="Deputy-Womens-Commissioner.php" class="deptwcom-link">
              <div class="div-deptwcom">
                <div class="dept-wcom">Deputy Women's Commissioner</div>
              </div>
             </a>
            
          </div>
        </div>

    <!--right container will come here-->
      <div class="card-right">
        <p>Role: Deputy Women's Commissioner</p>

        <div class="cards-container">
            <div class="studentCard-details">
            
            <div class="candidate-profile">
              <img src="img/candidate11.jpg" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">John Doe</div>
              <div class="candidate-role">Deputy Women's Commissioner</div>
            </div>

            <form action="cast_vote.php" method="POST">
              <input type="hidden" name="candidateName" value="Esi Serwaa">
              <input type="hidden" name="position" value="Deputy Womens Commissioner">
              <input type="hidden" name="nextPage" value="ThankYou.php">
              <button type="submit" class="vote-btn">Vote</button>
            </form>
          </div>

          <!-- Candidate 2 -->
          <div class="studentCard2-details">
            
            <div class="candidate-profile">
              <img src="img/candidate12.jpg" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">Grace Sullivan</div>
              <div class="candidate-role">Deputy Women's Commissioner</div>
            </div>

            <form action="cast_vote.php" method="POST">
              <input type="hidden" name="candidateName" value="Grace Sullivan">
              <input type="hidden" name="position" value="Deputy Women's Commissioner">
              <input type="hidden" name="nextPage" value="ThankYou.php">
              <button type="submit" class="vote-btn">Vote</button>
            </form>
          </div>
          <!--end of candidate 2-->
        </div>
      </div>
    </div>
  </div>

</body>
</html>