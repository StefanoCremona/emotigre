<?php
session_start();
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

if (!isset($_POST['screenName']) || !isset($_POST['password'])) {
    echo json_encode(new Message(false, 'Input not set properly!'));
    return;
}
    
$screenName = $_POST["screenName"];
$password = $_POST["password"];

$user = new User($screenName, $password);
$returnMessage = $user->registerUser();
if ($returnMessage->success == true) {
    $_SESSION["USER"] = $user;
    $returnMessage = $user->saveTweets($_SESSION["TWEETS"]);
}

echo json_encode($returnMessage);

?>