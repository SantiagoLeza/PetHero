<?php

namespace Models;

class Guardian extends User
{
    private $rating;
    private $fechaInicio;
    private $fechaFin;
    private $saldo;
    private $tamanio;

    public function __construct($mail, $password, $name, $phoneNumber, $birthdate, $adress, $dogs,$fechaInicio, $fechaFin,$tamanio){
        $this->mail = $mail;
        $this->password = $password;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->birthdate = $birthdate;
        $this->adress = $adress;
        $this->dogs = $dogs;
        $this->rating = 0;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->saldo = 0;
        $this->tamanio = $tamanio;
        
    }
}

function getRating(){
    return $this->rating;
}

function setRating($rating){
    $this->rating = $rating;
}

function getFechaInicio(){
    return $this->fechaInicio;
}

function setFechaInicio($fechaInicio){
    $this->fechaInicio = $fechaInicio;
}

function getFechaFin(){
    return $this->fechaFin;
}

function setFechaFin($fechaFin){
    $this->fechaFin = $fechaFin;
}

function getSaldo(){
    return $this->saldo;
}

function setSaldo($saldo){
    $this->saldo = $saldo;
}

function getTamanio(){
    return $this->tamanio;
}

function setTamanio($tamanio){
    $this->tamanio = $tamanio;
}


?>