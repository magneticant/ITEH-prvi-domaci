<?php

require "../DBBroker.php";
require "../model/prijava.php";

session_start();

$broker = DBBroker::instance('localhost', 'root',
'', 'itehprvidomaci');
$conn = $broker->conn;


    // var_dump($_POST);
$status = Prijava::deleteAll($conn, /*$_SESSION['user_id'],*/ $_COOKIE['userSpecificID']);
    if($status){
        echo "Success";
    }else{
        echo "Failed";
    }

