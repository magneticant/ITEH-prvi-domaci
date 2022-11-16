<?php

require "../DBBroker.php";
require "../model/prijava.php";

session_start();

$broker = DBBroker::instance('localhost', 'root',
'', 'itehprvidomaci');
$conn = $broker->conn;


if(isset($_POST["id"])){
   
    $status = Prijava::deleteSpecific($_POST["id"], $conn);
    if($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}
