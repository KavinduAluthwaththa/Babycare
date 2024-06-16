<?php
session_start();

include "DBcon.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM parent WHERE Email=? AND Password=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row['Email'] === $email && $row['Password'] === $password) {
                    echo "Logged in!";
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['Fname'] = $row['Fname'];
                    $_SESSION['Lname'] = $row['Lname'];
                    $_SESSION['Username'] = $row['Username'];
                    $_SESSION['MOH'] = $row['MOH'];
                    $_SESSION['Wno'] = $row['Wno'];
                    $_SESSION['Tno'] = $row['Tno'];
                    $_SESSION['NIC'] = $row['NIC'];
                    $_SESSION['Password'] = $row['Password'];
                    header("Location: DBcon.php");
                    exit();
                } else {
                    header("Location: Login.php?error=Wrong Email or Password");
                    exit();
                }
            } else {
                header("Location: Login.php?error=Wrong Email or Password");
                exit();
            }
        }
    }
} else {
    header("Location: Login.php");
    exit();
}
?>
