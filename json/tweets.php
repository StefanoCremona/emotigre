<?php
session_start();
header('Content-type: application/json');
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

$returnMessage = [];

if (!isset($_POST['screen_name'])) {
    echo json_encode(new Message(false, 'Input not set properly!', []));
    return;
}

$screen_name = $_POST['screen_name'];

$user = new User($screen_name);
$user->getTweetsByScreenName();

echo json_encode(new Message(true, 'Operation Successful!'.$sql, $user->tweets));

?>