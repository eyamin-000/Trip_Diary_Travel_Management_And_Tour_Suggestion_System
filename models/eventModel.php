<?php
require_once 'dbConnect.php';

function getEventsByType($type) {
    global $conn;
    $type = mysqli_real_escape_string($conn, $type);
    $sql = "SELECT * FROM events WHERE event_type = '$type' AND is_accepted = 1 ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    return $result ? $result : false;
}

function enrollInEvent($user_id, $event_id) {
    global $conn;
    $check = "SELECT * FROM event_enrollments WHERE user_id = '$user_id' AND event_id = '$event_id'";
    $exists = mysqli_query($conn, $check);
    if(mysqli_num_rows($exists) > 0) return false;
    $sql = "INSERT INTO event_enrollments (user_id, event_id) VALUES ('$user_id', '$event_id')";
    return mysqli_query($conn, $sql);
}

function getAllEventsForAdmin() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
}
function acceptEvent($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    return mysqli_query($conn, "UPDATE events SET is_accepted = 1 WHERE id = '$id'");
}
function deleteEvent($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    return mysqli_query($conn, "DELETE FROM events WHERE id = '$id'");
}

function getAllUsers() {
    global $conn;
    return mysqli_query($conn, "SELECT id, username, role FROM users ORDER BY id DESC");
}

function deleteUser($id) {
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    
    mysqli_query($conn, "DELETE FROM event_enrollments WHERE user_id = '$id'");
    
    $sql = "DELETE FROM users WHERE id = '$id'";
    return mysqli_query($conn, $sql);
}
?>