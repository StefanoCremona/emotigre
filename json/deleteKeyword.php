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

if (!isset($_POST['keyword'])) {
    echo json_encode(new Message(false, 'Input not set properly!'));
    return;
}

$keyword = $_POST["keyword"];

$myDbHelper = new DBHelper();
$conn = $myDbHelper->getConnection();

$stmt = mysqli_stmt_init($conn);
$query = "DELETE from `comp1678_keywords` WHERE KEYWORD = ?";

    if(!mysqli_stmt_prepare($stmt, $query)) {
        echo json_encode(new Message(false, 'Failed to prepare statement:'.mysqli_stmt_error($stmt))); 
        return;
    }
    if(!mysqli_stmt_bind_param($stmt, 's', strtoupper($keyword))) {
        echo json_encode(new Message(false, 'Failed to bind variables:'.mysqli_stmt_error($stmt)));
        return;
    }
    if(!mysqli_stmt_execute($stmt)) {
        echo json_encode(new Message(false, 'Failed to execute statement:'.mysqli_stmt_error($stmt)));
        return;
    }

$stmt->close();
$myDbHelper->closeConnection();

echo json_encode(new Message(true, 'Operation Successful!'));

?>