<?php
session_start();

include "DBcon.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['moh']) && isset($_POST['wno']) && isset($_POST['tno']) && isset($_POST['nic'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $moh = validate($_POST['moh']);
    $wno = validate($_POST['wno']);
    $tno = validate($_POST['tno']);
    $nic = validate($_POST['nic']);

    if (empty($email) || empty($password) || empty($fname) || empty($lname) || empty($username) || empty($moh) || empty($wno) || empty($tno) || empty($nic)) {
        header("Location: registermidwife.html?error=All fields are required");
        exit();
    } else {
        // Check if email already exists
        $sql = "SELECT * FROM midwife WHERE Email=?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                header("Location: registermidwife.html?error=Email already exists");
                exit();
            } else {
                // Insert new user
                $sql = "INSERT INTO midwife (Fname, Lname, Username, Email, Password, MOH, Wno, Tno, NIC) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                    exit();
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                    mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $lname, $username, $email, $hashed_password, $moh, $wno, $tno, $nic);
                    mysqli_stmt_execute($stmt);
                    header("Location: index.php?success=Account created successfully");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: registermidwife.html");
    exit();
}
?>
