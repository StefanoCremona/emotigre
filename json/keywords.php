<?php
session_start();
header('Content-type: application/json');
include '../dbConnection.php';
include_once '../utils/Message.php';
include_once '../models/user.php';

$returnMessage = [];

/* if (!isset($_SESSION["USER"])) {
    echo json_encode(new Message(false, 'You need to login to get this data!'));
    return;
} */

$myDbHelper = new DBHelper();
$conn = $myDbHelper->getConnection();

$sql = "SELECT * FROM `comp1678_keywords`";
$result = mysqli_query($conn, $sql);

/* while (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $x = new stdClass();
    $x->keyword = $row["KEYWORD"];
    $x->positive = $row["POSITIVE"];
    array_push($returnMessage, $x);
} */

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $x = new stdClass();
        $x->keyword = $row["KEYWORD"];
        $x->positive = $row["POSITIVE"];
        array_push($returnMessage, $x);
    }
}

echo json_encode(new Message(true, 'Operation Successful!', $returnMessage));

?>