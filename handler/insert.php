<?php
require "../DBBroker.php";
require "../model/prijava.php";
require "../model/doktor.php";
require "../model/korisnik.php";

$user = $_POST['username'];
$pass = $_POST['password'];

$conn = DBBroker::instance('localhost', $user,
$pass, 'itehprvidomaci');

if(isset($_POST['ime i prezime lekara']) && isset($_POST['odeljenje']) 
&& isset($_POST['sala']) && isset($_POST['datum'])){
    $k = new Korisnik(1, $_POST['username'], $_POST['password']);
    $d = Doktor::selectSpecificDoctor($conn, $_POST['ime i prezime lekara'])[0];
    $prijava = new Prijava(null, $_POST['odeljenje'], $_POST['sala'], $_POST['datum'], $k, $d);
    $status = Prijava::insert($conn, $prijava);
}