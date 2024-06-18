<?php
session_start();
include('DBcon.php');

if (isset($_POST['register_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $moh = mysqli_real_escape_string($conn, $_POST['moh']);
    $wno = mysqli_real_escape_string($conn, $_POST['wno']);
    $tno = mysqli_real_escape_string($conn, $_POST['tno']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    if ($password === $confirmpassword) {
        $checkemail = "SELECT email FROM midwife WHERE email='$email' LIMIT 1";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['message'] = "Email Already Exists";
            header("Location: registermidwife.php");
            exit(0);
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $user_query = "INSERT INTO midwife (fname, lname, username, email, password, moh, wno, tno) VALUES ('$fname', '$lname', '$username', '$email', '$hashed_password', '$moh', '$wno', '$tno')";
            $user_query_run = mysqli_query($conn, $user_query);

            if ($user_query_run) {
                $_SESSION['message'] = "Registered Successfully";
                header("Location: registermidwife.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong!";
                header("Location: registermidwife.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Password and Confirm Password do not match";
        header("Location: registermidwife.php");
        exit(0);
    }
} else {
    header("Location: registermidwife1.php");
    exit();
}
?>