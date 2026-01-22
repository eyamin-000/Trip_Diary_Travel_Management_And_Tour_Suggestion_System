<?php
session_start();
require_once '../models/tripModel.php';

if (isset($_GET['action']) && $_GET['action'] == 'search') {
    $q = $_GET['q'];
    $results = searchDestinations($q);
    echo json_encode($results);
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'add_plan') {
    if(!isset($_SESSION['user'])) { echo json_encode(['status'=>'error','msg'=>'Session expired']); exit; }
    
    $user_id = $_SESSION['user']['id'];
    $dest = $_POST['destination'];
    $day = $_POST['day'];
    $transport = $_POST['transport'];
    $note = $_POST['note'];
    $location = $_POST['location'];
    $budget = $_POST['budget'];

    $result = addPlannedTrip($user_id, $dest, $day, $transport, $note, $location, $budget);
    
    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Failed to save plan!']);
    }
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'delete_plan') {
    $id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];

    if (deletePlannedTrip($id, $user_id)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Delete failed!']);
    }
    exit;
}
?>