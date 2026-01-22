<?php
session_start();
require_once '../models/eventModel.php';

if (isset($_POST['action']) && $_POST['action'] == 'enroll') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(['status' => 'error', 'msg' => 'Please login first!']);
        exit;
    }
    
    $user_id = $_SESSION['user']['id'];
    $event_id = $_POST['event_id'];
    
    $result = enrollInEvent($user_id, $event_id);
    
    if ($result) {
        echo json_encode(['status' => 'success', 'msg' => 'Enrolled successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'You have already enrolled or something went wrong!']);
    }
    exit;
}
?>