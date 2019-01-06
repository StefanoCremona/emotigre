<?php
include_once './dbConnection.php';
include_once './utils/Message.php';

class User
{
    public $id;
    public $screenName;
    public $userName;
    public $password;

    function __construct()
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }

    function __construct2($userName, $password) { 
        $this->userName = $userName;
        $this->password = $password;
    }

    function getUserByUsernamAndPassword() { 
        $myDbHelper = new DBHelper();
        $conn = $myDbHelper->getConnection();

        if (!isset($this->userName) || !isset($this->password)) return new Message(false, 'Input not set properly!');//die ('No screen name provided');

        $sql = "SELECT * FROM `comp1678_user` WHERE USERNAME = '".$this->userName."' AND PASSWORD = '".$this->password."'";
        $result = mysqli_query($conn, $sql);
        $returnMessage = new Message(true, 'Operation Succesful!');

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->id = $row["ID"];
            $this->screenName = $row["SCREEN_NAME"];
            //$this->userName = $row["USERNAME"];
        } else {
            //echo $screenName." not found!";
            $returnMessage->success = false;
            $returnMessage->message = 'Wrong username or password!';
        }

        $myDbHelper->closeConnection();
        return $returnMessage;
    }

    function getUserByScreenName($screenName) {
        $myDbHelper = new DBHelper();
        $conn = $myDbHelper->getConnection();

        if (!isset($screenName)) return;//die ('No screen name provided');

        $sql = "SELECT * FROM `comp1678_user` WHERE SCREEN_NAME = '".$screenName."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->id = $row["ID"];
            $this->screenName = $row["SCREEN_NAME"];
            $this->userName = $row["USERNAME"];
            echo 'Got record</br>';
        } //else {
        //    echo $screenName." not found!";
        //}

        $myDbHelper->closeConnection();
    }
}

?>