<?php
require_once '../models/dbConnect.php';

if (isset($_POST['action']) && $_POST['action'] == 'calculate_cost') {
    $from = mysqli_real_escape_string($conn, $_POST['from']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);
    $transport = $_POST['transport'];

    $sql = "SELECT * FROM travel_costs 
            WHERE from_location = '$from' 
            AND to_location = '$to' 
            AND transport_type = '$transport'";
    
    $result = mysqli_query($conn, $sql);
    
    if($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'status' => 'success',
            'distance' => $row['distance_km'],
            'min' => $row['min_cost'],
            'max' => $row['max_cost'],
            'avg' => $row['avg_cost']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Route data not found in database!']);
    }
    exit;
}
?>