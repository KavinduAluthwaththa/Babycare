<?php
session_start();

include "DBcon.php";

if (isset($_POST['username']) && isset($_POST['childsname']) && isset($_POST['moh']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['lastname']) && isset($_POST['mobilenumber']) && isset($_POST['confirmpassword'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $childsname = validate($_POST['childsname']);
    $moh = validate($_POST['moh']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);
    $lastname = validate($_POST['lastname']);
    $mobilenumber = validate($_POST['mobilenumber']);
    $confirmpassword = validate($_POST['confirmpassword']);

    if (empty($username) || empty($childsname) || empty($moh) || empty($password) || empty($email) || empty($lastname) || empty($mobilenumber) || empty($confirmpassword)) {
        header("Location: registerparent.html?error=All fields are required");
        exit();
    } else if ($password !== $confirmpassword) {
        header("Location: registerparent.html?error=Passwords do not match");
        exit();
    } else {
        // Check if username or email already exists
        $sql = "SELECT * FROM parent WHERE Username=? OR Email=?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                header("Location: registerparent.html?error=Username or Email already exists");
                exit();
            } else {
                // Insert new parent
                $sql = "INSERT INTO parent (Username, ChildsName, MOHArea, Password, Email, LastName, MobileNumber) VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL error";
                    exit();
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                    mysqli_stmt_bind_param($stmt, "sssssss", $username, $childsname, $moh, $hashed_password, $email, $lastname, $mobilenumber);
                    mysqli_stmt_execute($stmt);
                    header("Location: loginparent.html?success=Account created successfully");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: registerparent.html");
    exit();
}
?>
