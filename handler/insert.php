<?php
require "../DBBroker.php";
require "../model/prijava.php";
require "../model/doktor.php";
require "../model/korisnik.php";

$broker = DBBroker::instance('localhost', 'root',
'', 'itehprvidomaci');
$conn = $broker->conn;

session_start();

if(isset($_POST['ime i prezime lekara']) && isset($_POST['odeljenje']) 
&& isset($_POST['sala']) && isset($_POST['datum'])){
  $k = new Korisnik();
  $idKorisnika = (int)$_SESSION['user_id'];
  $resultSetK = Korisnik::vrati_usera_po_id_u($conn, $idKorisnika);
  $objekatKorisnik = $resultSetK->fetch_array();
  $k->sifra = $idKorisnika;
  $k->kor_ime = $objekatKorisnik[1];
  $k->lozinka = $objekatKorisnik[2];
  
  $d = new Doktor();
  $resultSetD = Doktor::selectSpecificDoctor($conn, $_POST['ime i prezime lekara']);
  $objekatDoktor = $resultSetD->fetch_array();
  $d->id_doktora = $objekatDoktor[0];
  $d->ime_prezime = $objekatDoktor[1];

  // $d = Doktor::selectSpecificDoctor($conn, $_POST['ime i prezime lekara'])[0];
    $prijava = new Prijava(null, $_POST['odeljenje'], $_POST['sala'], $_POST['datum'], $k, $d);
    $status = Prijava::insert($conn, $prijava);
}