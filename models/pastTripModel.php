<?php
require_once 'dbConnect.php';

function addPastTrip($user_id, $dest, $type, $date, $country, $title, $desc) {
    global $conn;
    $sql = "INSERT INTO past_trips (user_id, destination, trip_type, trip_date, country, title, description) 
            VALUES ('$user_id', '$dest', '$type', '$date', '$country', '$title', '$desc')";
    return mysqli_query($conn, $sql);
}

function getUserPastTrips($user_id) {
    global $conn;
    $sql = "SELECT * FROM past_trips WHERE user_id = '$user_id' ORDER BY id DESC";
    return mysqli_query($conn, $sql);
}
?>