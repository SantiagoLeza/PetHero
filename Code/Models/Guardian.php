<?php

namespace Models;

class Guardian extends User
{
    private $rating;
    private $fechaInicio;
    private $fechaFin;
    private $saldo;
    private $tamanio;
    private $direccionCuidado;
    private $descripcion;

    public function __construct($mail, $password, $name, $phoneNumber, $birthdate, $adress, $dogs,$rating, $fechaInicio, $fechaFin, $saldo,$tamanio, $direccionCuidado, $descripcion){
        parent::__construct($mail, $password, $name, $phoneNumber, $birthdate, $adress, $dogs);
        $this->rating = $rating;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->saldo = $saldo;
        $this->tamanio = $tamanio;
        $this->direccionCuidado = $direccionCuidado;
        $this->descripcion = $descripcion;
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

    function getDireccionCuidado(){
        return $this->direccionCuidado;
    }

    function setDireccionCuidado($direccionCuidado){
        $this->direccionCuidado = $direccionCuidado;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    function __toString(){
        return $this->mail . " - " . $this->password . " - " . $this->name . " - " . $this->phoneNumber . " - " . $this->birthdate . " - " . $this->adress . " - " . $this->dogs . " - " . $this->rating . " - " . $this->fechaInicio . " - " . $this->fechaFin . " - " . $this->saldo . " - " . $this->tamanio . " - " . $this->direccionCuidado . " - " . $this->descripcion;
    }
}
?>