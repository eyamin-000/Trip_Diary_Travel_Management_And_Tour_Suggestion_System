<?php
session_start();
require_once '../models/eventModel.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'msg' => 'Unauthorized']);
    exit;
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $success = false;

    if ($action == 'accept_event' && $id) {
        if(acceptEvent($id)) $success = true;
    } 
    elseif ($action == 'delete_event' && $id) {
        if(deleteEvent($id)) $success = true;
    }
    elseif ($action == 'delete_user' && $id) {
        if(deleteUser($id)) $success = true;
    }

    if($success) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Operation failed on Database.']);
    }
    exit;
}
?>