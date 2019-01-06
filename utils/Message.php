<?php
class Message {
    public $success = true;
    public $message = null;
    
    function __construct() 
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }
    
    function __construct2($success, $message)
    {
        $this->success = $success;
        $this->message = $message;
    }
}

?>