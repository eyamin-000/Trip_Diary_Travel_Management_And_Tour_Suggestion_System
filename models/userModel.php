<?php
require_once 'dbConnect.php';

function loginUser($username, $password, $role) {
    global $conn;

    $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $row['password'])) {
            return $row;
        }
        else if ($password == $row['password']) {
            return $row;
        }
    }
    return false;
}

function registerUser($name, $username, $gender, $location, $age, $password, $role) {
    global $conn;

    $sql = "INSERT INTO users (name, username, gender, location, age, password, role) 
            VALUES ('$name', '$username', '$gender', '$location', '$age', '$password', '$role')";
    return mysqli_query($conn, $sql);
}

function checkUsername($username) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function updateProfile($id, $name, $location, $age, $password) {
    global $conn;
    if(!empty($password)) {
        $sql = "UPDATE users SET name='$name', location='$location', age='$age', password='$password' WHERE id='$id'";
    } else {
        $sql = "UPDATE users SET name='$name', location='$location', age='$age' WHERE id='$id'";
    }
    return mysqli_query($conn, $sql);
}
?>