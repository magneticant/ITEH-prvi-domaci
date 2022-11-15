<?php
require "../DBBroker.php";
require "../model/prijava.php";
require "../model/doktor.php";
require "../model/korisnik.php";

$broker = DBBroker::instance('localhost', 'root',
'', 'itehprvidomaci');
$conn = $broker->conn;

session_start();

echo '<pre>';
var_dump($_POST);
echo '</pre>';


//var_dump($_SESSION);
if(isset($_POST['imeIPrezimeLekara']) && isset($_POST['odeljenje']) 
&& isset($_POST['sala']) && isset($_POST['datum'])){

  $k = new Korisnik();
  $idKorisnika = (int)$_SESSION['user_id'];
  
  $resultSetK = Korisnik::SelectSpecificUserByID($conn, $idKorisnika);
  $k->sifra = (int)$resultSetK[0]['sifra'];
  $k->kor_ime = $resultSetK[0]['kor_ime'];
  $k->lozinka = $resultSetK[0]['lozinka'];

  //var_dump($k);
  $d = new Doktor();
  $resultSetD = Doktor::selectSpecificDoctor($conn, $_POST['imeIPrezimeLekara']);
  if(count($resultSetD) == 0){
    echo(`<script>alert("Nepostojeci doktor.");</script>`);
}
  //var_dump($resultSetD);
  $d->id_doktora = (int)$resultSetD[0]['id_doktora'];
  $d->ime_prezime = $resultSetD[0]['ime_prez'];
  //var_dump($d);

    $odelj = $_POST['odeljenje'];
    
    $sala =(int)$_POST['sala'];
    $datum = $_POST['datum'];
    $idPoslednjePrij = Prijava::returnHighestID($conn);
    if($idPoslednjePrij->num_rows == 0){
      $idPoslednjePrij = 0;
    }
    
    $idPrij = $idPoslednjePrij->num_rows + 1;
   
    var_dump($idPrij);
$prijava = new Prijava($idPrij, $odelj ,$sala ,$datum, $k, $d);
    var_dump($prijava);
    $status = Prijava::insert($conn, $prijava);
    if ($status){
      
      echo 'Success';
  }else{
      echo $status;
      echo 'Failed';
  }
}