<?php
session_start();
include "DBcon.php";

// Prepare SQL statement
$sql = "SELECT idchild, fname, lname, birthweight, dob FROM child WHERE idparent = ?";

// Prepare and execute the statement
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $_SESSION['idparent']);  // Bind the parent_id from session to the query
    $stmt->execute();
    $children_result = $stmt->get_result(); // Get the result set from the executed statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
    $children_result = false; // Indicate failure to retrieve children
}

$conn->close(); // Close the database connection
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

<nav>
    <ul class="sidebar">
        <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
        <li><a href="Home.html">Home</a></li>
        <li><a href="#">Profile</a></li>
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
        <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="http://www.w3.org/2000/svg" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
</nav>

<div class="container">
    <div class="form-container">
        <div class="form-box">
            <h2 style="text-align: left; font-weight: bold;">
                <?= htmlspecialchars($_SESSION['fname'], ENT_QUOTES) ?> <?= htmlspecialchars($_SESSION['lname'], ENT_QUOTES) ?>
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
                        <label for="email"><?= htmlspecialchars($_SESSION['nic'], ENT_QUOTES) ?></label>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= htmlspecialchars($_SESSION['moh'], ENT_QUOTES) ?></label>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= htmlspecialchars($_SESSION['email'], ENT_QUOTES) ?></label>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= htmlspecialchars($_SESSION['wno'], ENT_QUOTES) ?></label>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= htmlspecialchars($_SESSION['tno'], ENT_QUOTES) ?></label>
                    </div>
                </div>
            </form>

            <h4>Children's Information:</h4>
            <ul class="list">
                <?php if ($children_result && $children_result->num_rows > 0): ?>
                    <?php while ($child = $children_result->fetch_assoc()): ?>
                        <li>
                            <a href="viewchi.php?id=<?= htmlspecialchars($child['idchild'], ENT_QUOTES) ?>">
                                <?= htmlspecialchars($child['fname'], ENT_QUOTES) ?> <?= htmlspecialchars($child['lname'], ENT_QUOTES) ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No children found for this parent.</li>
                <?php endif; ?>
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
            <b class="lets-start-together">Let’s start together.</b>
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

<script>
  function logout() {
    window.location.href = 'logout.php'; // Redirect to logout script
  }
</script>

</body>
</html>
