<?php
session_start();
include('DBcon.php'); // Make sure this file connects to your database

if (isset($_POST['register_btn'])) {
    // Retrieve and sanitize form inputs
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $birthweight = mysqli_real_escape_string($conn, $_POST['birthweight']);
    
    // Validate inputs (basic example)
    if (!empty($fname) && !empty($lname) && !empty($dob) && !empty($birthweight)) {
        // Insert data into the database
        $query = "INSERT INTO children (fname, lname, dob, birthweight) VALUES ('$fname', '$lname', '$dob', '$birthweight')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['message'] = "Child registered successfully!";
            header("Location: registerchild.php"); // Redirect to the same page to display the success message
            exit(0);
        } else {
            $_SESSION['message'] = "Failed to register child. Please try again.";
            header("Location: registerchild.php"); // Redirect to the same page to display the error message
            exit(0);
        }
    } else {
        $_SESSION['message'] = "All fields are required!";
        header("Location: registerchild.php"); // Redirect to the same page to display the error message
        exit(0);
    }
} else {
    header("Location: registerchild.php"); // Redirect if the form is not submitted
    exit();
}
?>
