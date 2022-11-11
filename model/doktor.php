<?php

class Doktor{
    public $id_doktora;
    public $ime_prezime;
    
    public function __construct($id_doktora = null, $ime_prezime = null)
    {
        $this->id_doktora = $id_doktora;
        $this->ime_prezime = $ime_prezime;
    }


}