<?php
// Start the session
session_start();
include "DBcon.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION['login_user'])){
   header("location: loginmidwife.php");
   die();
}

$login_session = $_SESSION['login_user'];

// Prepare and bind
$stmt = $conn->prepare('SELECT fname, lname, moh, nic, wno, tno FROM midwife WHERE email = ?');
$stmt->bind_param('s', $_SESSION['login_user']);
$stmt->execute();
$stmt->bind_result($fname, $lname, $moh, $nic, $wno, $tno);
$stmt->fetch();

// Store the fetched data in session variables
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['moh'] = $moh;
$_SESSION['nic'] = $nic;
$_SESSION['wno'] = $wno;
$_SESSION['tno'] = $tno;

$stmt->close();
$conn->close();
?>

<html>
<head>
   <meta charset="utf-8">
   <title>Profile Page</title>
   <link href=".css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
</body>
</html>
