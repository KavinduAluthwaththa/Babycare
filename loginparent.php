<?php
session_start();

include "DBcon.php";
$error='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
   
      // username and password sent from form 
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 

      $sql = "SELECT password FROM parent WHERE email = '$myemail'";

      $result = mysqli_query($conn,$sql);      
      
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($mypassword, $hashed_password)) {
            // Password is correct
            $_SESSION['login_user'] = $myemail; // You can store other user information in session if needed
            $_SESSION['message'] = "Login Successful";
            header("Location: Dashboardparent.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['message'] = "Invalid Email or Password";
            header("Location: loginparent.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: loginparent.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@500;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap"/>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"/>
    <link rel="stylesheet" href="Styles/login.css">
    <style>
        .container {
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .left-section, .right-section {
            flex: 1;
            text-align: center;
        }
        .left-section img {
            max-width: 100%;
            height: auto;
        }
        .right-section {
            max-width: 400px;
            width: 100%;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .right-section .form-group {
            margin-bottom: 15px;
        }
        .right-section .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .right-section .form-check {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .right-section .form-check input {
            margin-right: 5px;
        }
        .right-section .btn {
            width: 100%;
        }
        .right-section .register-link {
            margin-top: 20px;
            text-align: center;
        }
        
        .google-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        .google-link img {
            margin-right: 10px;
            height: 20px;
        }

        .btn-google {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #e0e4e9;
            border: #343a40;
            color: rgb(8, 8, 8);
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .btn-google img {
            margin-right: 10px;
            height: 20px;
        }

        .btn-google:hover {
            background-color: #577b9e;
        }

        .right-section .btn-login {
            background-color: #577b9e;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="left-section">
            <img src="Images/LoginPage.png" alt="Description of Image">
        </div>
        <div class="right-section">
            <div class="welcome1">Welcome to </div>
            <div class="welcome">Baby Care System</div>
            <br>
            <a href="#" class="btn btn-light" style="height: 40px; display: inline-flex;justify-content: center;">

              <img src="Images/google.png" alt="Google Logo" style="height: 20px; margin-right: 10px;">
              <div class="gog" style="color: black;">Login with Google</div>

            </a>
          
            <p class="lead">or</p>
            <form action="" method="post">
                <div class="form-group">
                    <!--<label for="email">Enter email address</label>-->
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <!--<label for="password">Enter password</label>-->
                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                </div>

                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

                <div class="form-check">
                    <div>
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary mt-3" style="background-color: #6358DC;">Login</button>
                <div class="register-link">
                    <p>Don't have an account ? <a href="registerpatient.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>