<?php
session_start();
require_once '../models/pastTripModel.php';

if (isset($_POST['action']) && $_POST['action'] == 'save_past_trip') {
    if(!isset($_SESSION['user'])) { echo json_encode(['status'=>'error','msg'=>'Login first']); exit; }

    $user_id = $_SESSION['user']['id'];
    $dest = $_POST['destination'];
    $type = $_POST['trip_type'];
    $date = $_POST['trip_date'];
    $country = $_POST['country'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    if(addPastTrip($user_id, $dest, $type, $date, $country, $title, $desc)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Database error!']);
    }
    exit;
}
?>