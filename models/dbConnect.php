<?php
$host = "localhost";
$username = "root";
$pass = "";
$db   = "trip_diary";
$port = 3306;

$conn = mysqli_connect($host, $username, $pass, $db, $port);

if (!$conn) {
    die("DB Connection Failed");
}

//eta Important... Bar Bar Login chara access paoar jonno. eta pore thik korbo

/*if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && isset($_cookie['user_email'])) {
    require_once '../models/userModel.php';
    
    $email = $_COOKIE['user_email'];
    $user = getUserByEmail($email);

    if ($user) {
        $_SESSION['user'] = $user;
    }
}*/
?>


