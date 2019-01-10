<?php
session_start();
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

if (!isset($_POST['screenName'])) {
    echo json_encode(new Message(false, 'Input not set properly!'));
    return;
}
    
$screenName = $_POST["screenName"];

$user = new User($screenName);

//if ($returnMessage->success == true) {
    $_SESSION["USER"] = $user;
    $returnMessage = $user->deleteTweets();
    if ($returnMessage->success == true) {
        $returnMessage = $user->saveTweets($_SESSION["TWEETS"]);
    }
//}

echo json_encode($returnMessage);

?>