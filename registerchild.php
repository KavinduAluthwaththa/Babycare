<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@500;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap"/>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Styles/hf.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
            padding: 20px;
        }
        .image-container {
            flex: 1;
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 50px;
        }
        .form-container {
            flex: 1;
            padding: 20px;
        }
        .form-container .form-box {
            background: #fdfdfd;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p  {
            text-align: center;
            margin-top: 15px;
        }
        
        button{
            background-color: #577b9e;
        }

        .registration-form{
            display: flex;
            flex-direction: row;
            justify-content: space-between;   
        }
        .form-box{
            width: auto;
        }
        .left-side,
        .right-side {
            width: 48%;
        }
        .left-side{
            order: 1;
        }
        .right-side{
            order: 2;
        }
        .left-side, .right-side{
            padding: 20px;

        }
        .left-side h6, .right-side h6 {
            margin-top: 0;
        }

        .bottom-actions {
            width: 100%;
            text-align: center;
        }
        .bottom-actions button{
            padding: 10px 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="image-container">
            <img src="Images/ChildReg.png" alt="Description of Image">
        </div>
        <div class="form-container">
            <div class="form-box">
                
                <h2 style="text-align: center; font-weight: bold;">Baby Care System</h2>
                
                <form class="registration-form" action="PHP/RegisterChild.php" method="post">
                    <div class="left-side">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter child's name" required>
                        </div>
                        <div class="form-group">
                            <label for="birthweight">Birth Weight</label>
                            <input type="text" class="form-control" id="birthweight" name="birthweight" placeholder="Enter birth weight" required>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter DOB" required>
                        </div>
                    </div>
                
                    <br>
                <div class="bottom-actions">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>