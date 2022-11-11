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
        $kor_ime = $k->kor_ime;
        $lozinka = $k->lozinka;

        $upit = "SELECT * FROM user WHERE username='$k->kor_ime' and password='$k->lozinka'";

        return $conn->query($upit);
    }
}

