<?php

class Doktor{
    public $id_doktora;
    public $ime_prezime;
    // public $conn = DBBroker::instance('localhost', $_POST['username'],
    //  $_POST['password'], 'itehprvidomaci');

    public function __construct($id_doktora = null, $ime_prezime = null)
    {
        $this->id_doktora = $id_doktora;
        $this->ime_prezime = $ime_prezime;
    }

    public static function selectSpecificDoctor(mysqli $conn, $ime_prezime){
        $pretraga = "SELECT * from doktor where ime_prez = '$ime_prezime'";
        $nizOdg = array();
        if ($resultSet = $conn->query($pretraga)) {
            while ($red = $resultSet->fetch_array(1)) {
                $nizOdg[] = $red;
            }
        }
        return $nizOdg;
    }
    public static function selectSpecificDoctorByID(mysqli $conn, $id){
        $pretraga = "SELECT ime_prez from doktor where id_doktora = '$id'";
        $nizOdg = array();
        if ($resultSet = $conn->query($pretraga)) {
            while ($red = $resultSet->fetch_array(1)) {
                $nizOdg[] = $red;
            }
        }
        return $nizOdg;
    }
}