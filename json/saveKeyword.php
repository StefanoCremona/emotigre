<?php
session_start();
header('Content-type: application/json');
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

/* if (!isset($_SESSION["USER"])) {
    echo json_encode(new Message(false, 'You need to login to get this data!'));
    return;
} */

if (!isset($_POST['keyword']) || !isset($_POST['positive'])) {
    echo json_encode(new Message(false, 'Input not set properly!'));
    return;
}

$keyword = $_POST["keyword"];
$positive = $_POST["positive"];

$myDbHelper = new DBHelper();
$conn = $myDbHelper->getConnection();

$stmt = mysqli_stmt_init($conn);
$query = "INSERT INTO `comp1678_keywords` (KEYWORD, POSITIVE) VALUES (?, ?)";

    if(!mysqli_stmt_prepare($stmt, $query)) {
        echo json_encode(new Message(false, 'Failed to prepare statement:'.mysqli_stmt_error($stmt))); 
        return;
    }
    if(!mysqli_stmt_bind_param($stmt, 'si', strtoupper($keyword), $positive)) {
        echo json_encode(new Message(false, 'Failed to bind variables:'.mysqli_stmt_error($stmt)));
        return;
    }
    if(!mysqli_stmt_execute($stmt)) {
        echo json_encode(new Message(false, 'Failed to execute statement:'.mysqli_stmt_error($stmt)));
        return;
    }

echo json_encode(new Message(true, 'Operation Successful!'));

?>