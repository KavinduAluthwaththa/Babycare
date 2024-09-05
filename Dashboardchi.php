<?php
// Start the session
session_start();
include "DBcon.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION['login_user'])){
   header("location: loginparent.php");
   die();
}

$login_session = $_SESSION['login_user'];

// Prepare and bind
$stmt = $conn->prepare('SELECT fname, lname, moh, nic, wno, tno, email FROM child WHERE email = ?');
$stmt->bind_param('s', $_SESSION['login_user']);
$stmt->execute();
$stmt->bind_result($fname, $lname, $moh, $nic, $wno, $tno, $email);
$stmt->fetch();

// Store the fetched data in session variables
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['moh'] = $moh;
$_SESSION['nic'] = $nic;
$_SESSION['wno'] = $wno;
$_SESSION['tno'] = $tno;
$_SESSION['email'] = $email;

$stmt->close();

$parents_stmt = $conn->prepare('SELECT idparent, fname, lname, email FROM parent WHERE moh = ?');
$parents_stmt->bind_param('s', $_SESSION['moh']);
$parents_stmt->execute();
$parents_result = $parents_stmt->get_result();

$conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="Styles/index.css" />
	<link rel="stylesheet" href="Styles/dash.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@500;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap"/>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"/>
  </head>
  <body>

  <script>
  function logout() {
      // Send a request to logout.php
      fetch('logout.php', {
          method: 'POST', // You can also use GET if preferred
          credentials: 'same-origin' // To send cookies along with the request
      })
      .then(response => {
          if (response.redirected) {
              window.location.href = response.url; // Redirect to login.php
          }
      })
      .catch(error => console.error('Error:', error));
  }
  </script>
      
      <nav>
      <ul class="sidebar">
          <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
          <li><a href="Home.html">Home</a></li>
          <li><a href="">Profile</a></li>
          <li><a href="Information.html">Information</a></li>
          <li><a href="aboutus2.html">About</a></li>
          <li><a href="contact us.html">Contact</a></li>
      </ul>
      <ul>
          <li><img class="logo1" src="Images/Logo.png" alt="LogoImg" id="logo"></li>
          <li class="hideOnMobile"><a href="Home.html">Home</a></li>
          <li class="hideOnMobile"><a href="#">Profile</a></li>
          <li class="hideOnMobile"><a href="Information.html">Information</a></li>
          <li class="hideOnMobile"><a href="aboutus2.html">About</a></li>
          <li class="hideOnMobile"><a href="contact us.html">Contact</a></li>
          <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
      </ul>
      </nav>

	  <div class="container">
        <div class="form-container">
            <div class="form-box">
                
			<h2 style="text-align: left; font-weight: bold;">
				<?=htmlspecialchars($_SESSION['fname'], ENT_QUOTES)?> <?=htmlspecialchars($_SESSION['lname'], ENT_QUOTES)?>
			</h2>
				<form class="registration-form">
                    <div class="left-side">
                    <div class="form-group">
                        <label for="username">NIC:</label>
					</div>
                    <div class="form-group">
                        <label for="First name">MOH Area:</label>
					</div>
                    <div class="form-group">
                        <label for="DOB">Email:</label>
					</div>
                    <div class="form-group">
                        <label for="weight">Whatsapp No:</label>
					</div>
                    <div class="form-group">
                        <label for="weight">Contact No:</label>
					</div>
                   
                </div>

                <div class="right-side">
                    <div class="form-group">
                        <label for="email">
							<?=htmlspecialchars($_SESSION['nic'], ENT_QUOTES)?>
						</label>
					</div>
                    <div class="form-group">
                        <label for="email">
							<?=htmlspecialchars($_SESSION['moh'], ENT_QUOTES)?>
						</label>
					</div>
                    <div class="form-group">
                        <label for="email">
							<?=htmlspecialchars($_SESSION['email'], ENT_QUOTES)?>
						</label>
					</div>
                    <div class="form-group">
                        <label for="email">
							<?=htmlspecialchars($_SESSION['wno'], ENT_QUOTES)?>
						</label>
					</div>
                    <div class="form-group">
                        <label for="email">
							<?=htmlspecialchars($_SESSION['tno'], ENT_QUOTES)?>
						</label>
					</div>
                </div>
			</form>

            
            <h4>Parents in the same MOH area:</h4>
            <ul class="list">
                <?php while ($parent = $parents_result->fetch_assoc()) : ?>
                    <li>
                        <a href="viewpar.php?id=<?= $parent['idparent'] ?>">
                            <?= htmlspecialchars($parent['fname'], ENT_QUOTES) ?> <?= htmlspecialchars($parent['lname'], ENT_QUOTES) ?> (<?= htmlspecialchars($parent['email'], ENT_QUOTES) ?>)
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>

			<div class="container">
				<button class="logout" onclick="logout()">Logout</button>
			</div>
			
            </div>
        </div>
    </div>
  
      <div class="footer">
                  <footer>

                    <div class="div">
                      <b class="lets-start-together"> Let’s start together.</b>
                    </div>
    
                          <div class="contentx">
                            <div class="link-boxes">
                              <ul class="box">
                                  <div class="logo-details">
                                      <img class="logoo" src="Images/Logo.png" alt="">
                                  </div>
                              </ul>
                              <ul class="box">
                                  <li class="link_name">Pages</li>
                                  <li><a href="#">Home</a></li>
                                  <li><a href="#">Profile</a></li>
                                  <li><a href="#">Information</a></li>
                                  <li><a href="#">About</a></li>
                                  <li><a href="#">Contact</a></li>
                    
                              </ul>
                                <ul class="box">
                                  <li class="link_name">Contact</li>
                                  <li>74/1, </li>
                                  <li>Kandy Rd,</li>
                                  <li>Matale</li>
                                </ul>
                                
                              <div class="top">
                                  <div class="media-icons">
                                      <a href="#"><i class="fab fa-facebook-f"></i></a>
                                      <a href="#"><i class="fab fa-twitter"></i></a>
                                      <a href="#"><i class="fab fa-instagram"></i></a>
                                      <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                              </div>   
                              
                            </div>
                          </div>
                          <div class="bottom-details">
                            <div class="bottom_text">
                              <span class="copyright_text">Copyright © Baby Care</span>
                            </div>
                          </div>
                        </footer>
      </div>
 
  </body>
</html>
