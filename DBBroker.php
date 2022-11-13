<?php

class DBBroker{
    public static $instanciran = false;
    public mysqli $conn;

    private function __construct($conn)
    {
        $this->conn = $conn;
    }

 //Koriscenje singleton paterna za instanciranje DBBrokera.
 
  public static function instance($host, $user, $pass, $db){
        if(DBBroker::$instanciran == false){
            DBBroker::$instanciran = true;
            $conn = new mysqli($host, $user, $pass, $db);
            if ($conn->connect_errno) {
                exit("Neuspesna konekcija: $conn->connect_error err kod $conn->connect_errno");
            }
            $broker = new DBBroker($conn);
        }
        
        return $broker;
  }
}