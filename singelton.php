<?php


//Singelton is a class that can have only one instance

class singelton {

    private function __construct() {
        
    }

    public static function getInstance() {
        static $conn = null;
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $db = 'car-rental';
        if ($conn == null) {
            $conn = new mysqli($servername, $username, $password, $db);
        }
        return $conn;
    }

}

?>
