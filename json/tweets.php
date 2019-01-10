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

$myDbHelper = new DBHelper();
$conn = $myDbHelper->getConnection();

$sql = "SELECT * FROM `comp1678_tweet` where SCREEN_NAME = '".$screen_name."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $x = new stdClass();
        $x->id = $row["ID"];
        $x->screen_name_orig = $row["SCREEN_NAME_ORIG"];
        $x->screen_name = $row["SCREEN_NAME"];
        $x->text = $row["TEXT"];
        $x->date = $row["DATE"];
        array_push($returnMessage, $x);
    }
}

$myDbHelper->closeConnection();

echo json_encode(new Message(true, 'Operation Successful!'.$sql, $returnMessage));

?>