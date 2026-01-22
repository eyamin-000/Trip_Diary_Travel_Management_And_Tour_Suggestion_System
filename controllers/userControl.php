<?php
session_start();
require_once '../models/userModel.php';

if (isset($_POST['action']) && $_POST['action'] == 'update_profile') {
    $user_id = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if(!empty($pass) && $pass !== $repass) {
        echo json_encode(['status' => 'error', 'msg' => 'Passwords do not match!']);
        exit;
    }

    if(updateProfile($user_id, $name, $location, $age, $pass)) {

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['location'] = $location;
        $_SESSION['user']['age'] = $age;
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Update failed!']);
    }
    exit;
}
?>