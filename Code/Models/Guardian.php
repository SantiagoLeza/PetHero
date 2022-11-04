<?php

namespace Models;

use DAO\UserDAO as UserDAO;

class Guardian extends User
{
    private $idUsuario;
    private $user;
    private $idGuardian;
    private $rating;
    private $fechaInicio;
    private $fechaFin;
    private $saldo;
    private $tamanio;
    private $direccionCuidado;
    private $descripcion;

    public function __construct($idGuardian, $idUsuario, $rating, $fechaInicio, $fechaFin, $saldo,$tamanio, $direccionCuidado, $descripcion){

        $userDAO = new UserDAO();

        $this->idUsuario = $idUsuario;
        $this->user = $userDAO->getById($idUsuario);
        $this->idGuardian = $idGuardian;
        $this->rating = $rating;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->saldo = $saldo;
        $this->tamanio = $tamanio;
        $this->direccionCuidado = $direccionCuidado;
        $this->descripcion = $descripcion;
    }

    public function getIdGuardian(){
        return $this->idGuardian;
    }

    public function setIdGuardian($idGuardian){
        $this->idGuardian = $idGuardian;
    }

    function getRating(){
        return $this->rating;
    }

    function setRating($rating){
        $this->rating = $rating;
    }

    function getPrecio(){
        return 0;
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

    function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getMail(){
        return $this->user->getMail();
    }

    public function getName(){
        return $this->user->getName();
    }

    public function getSurname(){
        return $this->user->getSurname();
    }

    public function getTelefono(){
        return $this->user->getPhoneNumber();
    }

    function __toString(){
        return $this->mail . " - " . $this->password . " - " . $this->name . " - " . $this->phoneNumber . " - " . $this->birthdate . " - " . $this->adress . " - " . $this->dogs . " - " . $this->rating . " - " . $this->fechaInicio . " - " . $this->fechaFin . " - " . $this->saldo . " - " . $this->tamanio . " - " . $this->direccionCuidado . " - " . $this->descripcion;
    }
}
?>