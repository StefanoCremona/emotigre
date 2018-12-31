<?php
include_once './dbConnection.php';

$myDbHelper = new DBHelper();
$conn = $myDbHelper->getConnection();

if (!isset($screen_name)) die ('No screen name provided');

$sql = "SELECT `id` FROM `comp1678_user` WHERE SCREEN_NAME = '".$screen_name."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'User Already Exists!';
} else {
    echo "New User!";
}

$myDbHelper->closeConnection();

?>