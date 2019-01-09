<?php
include_once './dbConnection.php';
include_once './utils/Message.php';

class User
{
    public $id;
    public $screenName;
    public $userName;
    public $password;
    public $town;
    public $job;
    public $aboutme;
    public $agerange;
    public $kids;
    public $gender;

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
        $this->screenName = $userName;
        $this->password = md5($password);
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
            $this->userName = $row["USERNAME"];
            //$this->password = $row["PASSWORD"];
            $this->town = $row["TOWN"];
            $this->job = $row["JOB"];
            $this->aboutme = $row["ABOUTME"];
            $this->agerange = $row["AGERANGE"];
            $this->kids = $row["KIDS"];
            $this->gender = $row["GENDER"];
        } else {
            //echo $screenName." not found!";
            $returnMessage->success = false;
            $returnMessage->message = 'Wrong username or password!';
        }

        $myDbHelper->closeConnection();
        return $returnMessage;
    }

    function registerUser() {
        $myDbHelper = new DBHelper();
        $conn = $myDbHelper->getConnection();

        $stmt = mysqli_stmt_init($conn);
        $query = "INSERT INTO `comp1678_user` (USERNAME, SCREEN_NAME, PASSWORD) VALUES (?, ?, ?)";
        if(!mysqli_stmt_prepare($stmt, $query)) return (new Message(false, 'Failed to prepare statement:'.mysqli_stmt_error($stmt)));
        if(!mysqli_stmt_bind_param($stmt, 'sss', $this->userName, $this->screenName, $this->password)) return (new Message(false, 'Failed to bind variables:'.mysqli_stmt_error($stmt)));
        if(!mysqli_stmt_execute($stmt)) return (new Message(false, 'Failed to execute statement:'.mysqli_stmt_error($stmt)));
 
        $stmt->close();
        $myDbHelper->closeConnection();
        return new Message(true, 'Operation successful!');
    }

    function saveTweets($tweets) {
        $myDbHelper = new DBHelper();
        $conn = $myDbHelper->getConnection();

        $stmt = mysqli_stmt_init($conn);
        $query = "INSERT INTO `comp1678_tweet` (SCREEN_NAME_ORIG, SCREEN_NAME, TEXT) VALUES (?, ?, ?)";
        foreach ($tweets as $key => $value) {
            if(!mysqli_stmt_prepare($stmt, $query)) return (new Message(false, 'Failed to prepare statement:'.mysqli_stmt_error($stmt)));
            //$twt = $value["text"];
            $screenName = $value["retweeted_status"]["user"]["screen_name"];
            $text = $value["retweeted_status"]["text"];
            if (strlen($screenName) > 0 && strlen($text) > 0) {
                if(!mysqli_stmt_bind_param($stmt, 'sss', $this->screenName, $screenName, $text)) return (new Message(false, 'Failed to bind variables:'.mysqli_stmt_error($stmt)));
                if(!mysqli_stmt_execute($stmt)) return (new Message(false, 'Failed to execute statement:'.mysqli_stmt_error($stmt)));
            }
        }
 
        $stmt->close();
        $myDbHelper->closeConnection();
        return new Message(true, 'Operation successful!');
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