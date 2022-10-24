<?php

namespace Models;

class Animal
{
    private $mailDuenio;
    private $tipo;
    private $nombre;
    private $tamanio;
    private $raza;
    private $edad;
    private $sexo;

    public function __construct($mailDuenio, $tipo, $nombre, $tamanio, $raza, $edad, $sexo){
        $this->mailDuenio = $mailDuenio;
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->tamanio = $tamanio;
        $this->raza = $raza;
        $this->edad = $edad;
        $this->sexo = $sexo;
    }

    public function getMailDuenio(){
        return $this->mailDuenio;
    }

    public function setMailDuenio($mailDuenio){
        $this->mailDuenio = $mailDuenio;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
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
        return $this->sexo;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
}