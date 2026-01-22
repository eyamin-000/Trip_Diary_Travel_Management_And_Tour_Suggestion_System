<?php
require_once 'dbConnect.php';

function getTravelCost($from, $to) {
    global $conn;
    $sql = "SELECT cost FROM travel_costs WHERE from_location = '$from' AND to_location = '$to'";
    $result = mysqli_query($conn, $sql);
    
    if($row = mysqli_fetch_assoc($result)) {
        return $row['cost'];
    }
    return false;
}
?>