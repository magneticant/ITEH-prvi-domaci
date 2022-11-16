<?php

class Prijava{
    public $id_prijave;
    public $odeljenje;
    public $sala;
    public $datum;
    public Korisnik $pacijent;
    public Doktor $doktor;
    //public $conn = DBBroker::instance('localhost', $_POST['username'],
    // $_POST['password'], 'itehprvidomaci');

    public function __construct($id_prijave = null, $odelj = null,
     $sala = null, $dat = null, Korisnik $k = null, Doktor $d = null)
    {
        $this->id_prijave = $id_prijave;
        $this->odeljenje = $odelj;
        $this->sala = $sala;
        $this->datum = $dat;
        $this->pacijent = $k;
        $this->doktor = $d;
    }
    
    // Sada je potrebno implementirati CRUD operacije za rad sa prijavama.
    
    // Insert - C

    public static function insert($conn, Prijava $prijava){
        $upit = "insert into prijava(id_prijave ,odeljenje, sala, datum, id_korisnika, id_doktora) values ('$prijava->id_prijave','$prijava->odeljenje', '$prijava->sala', '$prijava->datum','{$prijava->pacijent->sifra}', '{$prijava->doktor->id_doktora}')";

              return $conn->query($upit);
    }

    // Select - R
    public static function selectAll($conn, $id){
        return $conn->query("select * from prijava where id_korisnika = '$id'");
    }

    // Select - R, specificni
    public static function selectSpecific($conn, $id){
        $pretraga = "SELECT * FROM prijave WHERE id=$id";
        $nizOdg = array();
        if ($resultSet = $conn->query($pretraga)) {
            while ($red = $resultSet->fetch_array(1)) {
                $nizOdg[] = $red;
            }
        }
        return $nizOdg;
    }

    // Update - U
    public static function updateSpecific(mysqli $conn, Prijava $prijava){
        return $conn->query("update prijava set odeljenje = $prijava->odeljenje, sala = $prijava->sala, datum = $prijava->datum, id_korisnika = $prijava->pacijent->sifra, id_doktora = $prijava->doktor->id_doktora where id_prijave = $prijava->id_prijave,");
    }

    // Delete - D
    public static function deleteSpecific($id,mysqli $conn){
        return $conn->query("delete from prijava where id_prijave = $id");
    }

    public static function deleteAll($conn, $id){
        return $conn->query("delete from prijava where id_korisnika = $id");
    }

    public static function returnHighestID(mysqli $conn){
        return $conn->query("SELECT id_prijave from prijava order by id_prijave DESC");
    }
}