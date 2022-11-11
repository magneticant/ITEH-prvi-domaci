<?php

class Prijava{
    public $id_prijave;
    public $odeljenje;
    public $sala;
    public $datum;
    public Korisnik $pacijent;
    public Doktor $doktor;


    public function __construct($id_prijave = null, $odelj = null,
     $sala = null, $dat = null, Korisnik $k = null, Doktor $d = null)
    {
        $this->id_prijave = $id_prijave;
        $odeljenje = $odelj;
        $this->sala = $sala;
        $datum = $dat;
        $pacijent = $k;
        $doktor = $d;
    }

    // Sada je potrebno implementirati CRUD operacije za rad sa prijavama.
    
    // Insert - C

    public function insert($conn, Prijava $prijava){
        $upit = "insert into prijava( odeljenje, sala, datum, id_korisnika, id_doktora)"
              + "values ('$prijava->odeljenje', '$prijava->sala', '$prijava->datum',"
              + " '$prijava->pacijent->sifra', '$prijava->doktor->id_doktora'";

              return $conn->query($upit);
    }

    // Select - R
    public function selectAll($conn){
        return $conn->query("select * from pretraga");
    }

    // Select - R, specificni
    public function selectSpecific($conn, $id){
        $pretraga = "SELECT * FROM prijave WHERE id=$id";
        $nizOdg = array();
        if ($resultSet = $conn->query($pretraga)) {
            while ($red = $resultSet->fetch_array(1)) {
                $nizOdg[] = $red;
            }
        }
        return $nizOdg;
    }

    // Update - U, specificni
    public function updateSpecific(mysqli $conn){
        return $conn->query("update prijava set odeljenje = $this->odeljenje, sala = $this->sala, datum = $this->datum, id_korisnika = $this->pacijent->sifra, id_doktora = $this->doktor->id_doktora where id_prijave = $this->id_prijave,");
    }

    // Delete - D, specificni
    public function deleteSpecific(mysqli $conn){
        return $conn->query("delete from prijava where id = $this->id");
    }
}