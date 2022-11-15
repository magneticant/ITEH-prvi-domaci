<?php

class Korisnik{
    public $sifra;
    public $kor_ime;
    public $lozinka;

    public function __construct($sifra = null, $kor_ime = null, $lozinka = null)
    {
        $this->sifra = $sifra;
        $this->kor_ime = $kor_ime;
        $this->lozinka = $lozinka;
    }
    public static function prijavi_korisnika(Korisnik $k, mysqli $conn){
        // $kor_ime = $k->kor_ime;
        // $lozinka = $k->lozinka;

        $upit = "SELECT * FROM korisnik WHERE kor_ime='$k->kor_ime' and lozinka='$k->lozinka'";
        
        return $conn->query($upit);
    }
    public static function vrati_id_usera(mysqli $conn, $username, $password){
        $upit = "SELECT sifra from korisnik where kor_ime = '$username' and  lozinka = '$password'";

        return $conn->query($upit);
    }
    public static function vrati_usera_po_id_u(mysqli $conn, $id){
        $upit = "SELECT * from korisnik where sifra = '$id'";

        return $conn->query($upit);
    }
    public static function SelectSpecificUserByID(mysqli $conn, $id){
        $pretraga = "SELECT * from korisnik where sifra = '$id'";
        $nizOdg = array();
        if ($resultSet = $conn->query($pretraga)) {
            while ($red = $resultSet->fetch_array(1)) {
                $nizOdg[] = $red;
            }
        }
        return $nizOdg;
    }
}

