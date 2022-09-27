<?php

namespace Models;

class Perro{
    private $mailDuenio;
    private $nombre;
    private $tamanio;
    private $raza;
    private $edad;
    private $sexo;

    public function __construct($mailDuenio, $nombre, $tamanio, $raza, $edad, $sexo){
        $this->mailDuenio = $mailDuenio;
        $this->nombre = $nombre;
        $this->tamanio = $tamanio;
        $this->raza = $raza;
        $this->edad = $edad;
        $this->sexi = $sexo;
    }

    public function getMailDuenio(){
        return $this->mailDuenio;
    }

    public function setMailDuenio($mailDuenio){
        $this->mailDuenio = $mailDuenio;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getTamanio(){
        return $this->tamanio;
    }

    public function setTamanio($tamanio){
        $this->tamanio = $tamanio;
    }

    public function getRaza(){
        return $this->raza;
    }

    public function setRaza($raza){
        $this->raza = $raza;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){
        $this->edad = $edad;
    }

    public function getSexo(){
        return $sexo->sexo;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
}