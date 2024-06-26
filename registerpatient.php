<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page Parent</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="Styles/register.css" rel="stylesheet">
</head>
<body>

    <div class="container">
    <div class="row">
        <div class="col">

            <div class="image-container">
                <img src="Images/ParentLogin.png" alt="Parent Registration">
            </div>

        </div>

        <div class="col">

        <div class="form-container">
            <div class="form-box">
                <h6 style="text-align: center;">Sign up to</h6>
                <h2 style="text-align: center; font-weight: bold;">Baby Care System</h2>
                <h6 style="text-align: center; font-size: smaller; color: #343a40;">As a Parent</h6>

                <form class="registration-form" action="regpar.php" method="post">
                    
                    <div class="container">
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                            </div>
                        </div>
        
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                        </div>
                        </div>
        
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
                            </div>
                        </div>
        
                        <div class="col">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="moh">MOH Area</label>
                                    <input type="text" class="form-control" id="moh" name="moh" placeholder="Enter MOH Area" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="nic">NIC</label>
                                    <input type="tel" class="form-control" id="nic" name="nic" placeholder="Enter NIC" required>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="wno">Whatsapp Number</label>
                                    <input type="tel" class="form-control" id="wno" name="wno" placeholder="Enter Whatsapp Number" required>
                                </div>
                            </div>
        
                            <div class="col">
                                <div class="form-group">
                                    <label for="tno">Mobile Number</label>
                                    <input type="tel" class="form-control" id="tno" name="tno" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                </div>
                            </div>
        
                            <div class="col">
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        
                        <br>

                        <div class="row">
                            <div class="col">
                            <?php
                                if(isset($_SESSION['message'])) {
                                    echo '<h4 class="alert alert-warning">'.$_SESSION['message'].'</h4>';
                                    unset($_SESSION['message']);
                                }
                            ?>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="bottom-actions">
                                    <button type="submit" name="register_btn" class="btn btn-primary btn-block">Register</button>
                                    <p>Already have an account ? <a href="loginparent.php">Login</a></p>
                                </div>
                            </div>
                        </div>
        
                    </div>
                
                </form>
            </div>
        </div>

        </div>

    </div>
    
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
