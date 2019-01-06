<?php
session_start();
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

if (!isset($_POST['userName']) || !isset($_POST['password'])) {
    echo json_encode(new Message(false, 'Input not set properly!'));
    return;
}
    
$userName = $_POST["userName"];
$password = $_POST["password"];

$user = new User($userName, $password);
$returnMessage = $user->getUserByUsernamAndPassword();
$_SESSION["USER"] = $user;

echo json_encode($returnMessage);

?>