<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>President Voting Page</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="img/wiuc1wbg.png" type="image/png">
</head>
<body>

  <!-- Navbar -->
<?php 
include("navbar.php");
?>

  <!-- Page Content -->
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
                <div class="main-wcom">Women’s Commissioner</div>
              </div>
             </a>
            

            <!-- Deputy Women's Commissioner -->
             <a href="Deputy-Womens-Commissioner.php" class="deptwcom-link">
              <div class="div-deptwcom">
                <div class="dept-wcom">Deputy Women’s Commissioner</div>
              </div>
             </a>
            
          </div>
        </div>

    <!--right container will come here-->
      <div class="card-right">
        <p>Role: President</p>

        <div class="cards-container">
            <div class="studentCard-details">
            
            <div class="candidate-profile">
              <img src="img/candidate7.avif" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">John Doe</div>
              <div class="candidate-role">Chairman</div>
            </div>

                        <form method="POST" action="cast_vote.php">
              <input type="hidden" name="candidateName" value="Kwame Mensah"> <!-- Candidate name -->
              <input type="hidden" name="position" value="President"> <!-- Position name (e.g., 'President') -->
              <button type="submit" class="vote-btn">Vote</button>
            </form>
          </div>

          <!-- Candidate 2 -->
          <div class="studentCard2-details">
            
            <div class="candidate-profile">
              <img src="img/candidate1.webp" alt="student-image">
            </div>

            <div class="student-info">
              <div class="candidate-name">Jane Doe</div>
              <div class="candidate-role">Nobody</div>
            </div>

            <form method="POST" action="cast_vote.php">
              <input type="hidden" name="candidateName" value="Kwame Mensah"> <!-- Candidate name -->
              <input type="hidden" name="position" value="President"> <!-- Position name (e.g., 'President') -->
              <button type="submit" class="vote-btn">Vote</button>
            </form>

          </div>
          <!--end of candidate 2-->
        </div>
      </div>
    </div>
  </div>
  
  <a href="General-Secretary.php" class="nextbtn-link">
    <button type="button" class="nextbtn">NEXT</button>
  </a>
  
</body>
</html>