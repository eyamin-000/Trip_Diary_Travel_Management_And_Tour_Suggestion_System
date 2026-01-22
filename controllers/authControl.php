<?php
session_start();
require_once '../models/userModel.php';

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $user = loginUser($username, $password, $role);

    if ($user) {
        $_SESSION['user'] = $user;

        echo json_encode(['status' => 'success', 'role' => $user['role']]);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Invalid Username, Password or Role!']);
    }
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'signup') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $re_pass = $_POST['re_password'];
    $role = $_POST['role'];

    if($password !== $re_pass) {
        echo json_encode(['status' => 'error', 'msg' => 'Passwords do not match!']);
        exit;
    }

    if(checkUsername($username)) {
        echo json_encode(['status' => 'error', 'msg' => 'Username already exists!']);
        exit;
    }

    $result = registerUser($name, $username, $gender, $location, $age, $password, $role);

    if ($result) {
        echo json_encode(['status' => 'success', 'msg' => 'Registration Successful!']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Database error!']);
    }
    exit;
}
if($res['role'] === 'admin') {

    echo json_encode(['status' => 'success', 'role' => 'admin']); 
}

//eta Important... Bar Bar Login chara access paoar jonno. eta pore thik korbo

/*if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = verifyUser($email, $password); 

    if ($user) {
        $_SESSION['user'] = $user;

        if (isset($_POST['remember'])) {
            setcookie('user_email', $user['email'], time() + (86400 * 30), "/");
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
        }

        header("Location: ../views/dashboard.php");
    } else {
        echo "Invalid login!";
    }
}*/



?>