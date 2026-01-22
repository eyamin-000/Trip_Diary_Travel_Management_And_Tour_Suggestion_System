<?php
require_once 'dbConnect.php';

function getPopularDestinations() {
    global $conn;
    $sql = "SELECT name FROM destinations WHERE is_popular = 1";
    $result = mysqli_query($conn, $sql);
    
    $destinations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $destinations[] = $row;
    }
    return $destinations;
}

function searchDestinations($query) {
    global $conn;
    $sql = "SELECT * FROM destinations WHERE name LIKE '%$query%' LIMIT 5";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function getAllSuggestions() {
    global $conn;
    $sql = "SELECT * FROM destinations ORDER BY id DESC";
    return mysqli_query($conn, $sql);
}

function addPlannedTrip($user_id, $dest, $day, $transport, $note, $loc, $budget) {
    global $conn;
    $sql = "INSERT INTO planned_trips (user_id, destination, day, transport, note, location, budget) 
            VALUES ('$user_id', '$dest', '$day', '$transport', '$note', '$loc', '$budget')";
    return mysqli_query($conn, $sql);
}

function getUserPlannedTrips($user_id) {
    global $conn;
    $sql = "SELECT * FROM planned_trips WHERE user_id = '$user_id' ORDER BY id DESC";
    return mysqli_query($conn, $sql);
}

function deletePlannedTrip($id, $user_id) {
    global $conn;
    $sql = "DELETE FROM planned_trips WHERE id = '$id' AND user_id = '$user_id'";
    return mysqli_query($conn, $sql);
}
?>