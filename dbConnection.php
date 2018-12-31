<?php
class DBHelper {

    private static $host = 'mysql.cms.gre.ac.uk';
    private static $user = 'sc1984h';	// YOUR username here
    private static $passwd = 'sc1984h';	// YOUR Password here
    private static $dbname = 'mdb_sc1984h';// YOUR database name here
    
    private $connection = null;
    
    function __construct()
    {
        //echo 'DBHelper';
        $this->$connection = mysqli_connect(self::$host, self::$user, self::$passwd, self::$dbname) or die('Failed to connect to MySQL server. ' . mysqli_connect_error());
    }
    
    public function getConnection() {
        return $this->$connection;
    }
    
    public static function closeConnection() {
        if(is_null($connection)) {
            return;
        }
        $connection->close();       
    }
    
}

?>