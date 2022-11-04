<?php

namespace Models;

class Animal
{
    private $idAnimales;
    private $tipo;
    private $raza;
    private $tamanio;
    private $nombre;
    private $edad;
    private $sexo;
    private $idImagenPerfil;
    private $idVideo;
    private $idCartaVacunacion;
    private $idDuenio;
    private $observaciones;


    public function __construct($idAnimales, $tipo, $raza, $tamanio, $nombre, $edad, $sexo, $idImagenPerfil, $idVideo, $idCartaVacunacion, $idDuenio, $observaciones){
        $this->idAnimales = $idAnimales;
        $this->tipo = $tipo;
        $this->raza = $raza;
        $this->tamanio = $tamanio;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->idImagenPerfil = $idImagenPerfil;
        $this->idVideo = $idVideo;
        $this->idCartaVacunacion = $idCartaVacunacion;
        $this->idDuenio = $idDuenio;
        $this->observaciones = $observaciones;
    }

    public function getIdAnimales()
    {
        return $this->idAnimales;
    }

    public function setIdAnimales($idAnimales)
    {
        $this->idAnimales = $idAnimales;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;
    }

    public function getTamanio()
    {
        return $this->tamanio;
    }

    public function setTamanio($tamanio)
    {
        $this->tamanio = $tamanio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getIdImagenPerfil()
    {
        return $this->idImagenPerfil;
    }

    public function setIdImagenPerfil($idImagenPerfil)
    {
        $this->idImagenPerfil = $idImagenPerfil;
    }

    public function getIdVideo()
    {
        return $this->idVideo;
    }

    public function setIdVideo($idVideo)
    {
        $this->idVideo = $idVideo;
    }

    public function getIdCartaVacunacion()
    {
        return $this->idCartaVacunacion;
    }

    public function setIdCartaVacunacion($idCartaVacunacion)
    {
        $this->idCartaVacunacion = $idCartaVacunacion;
    }

    public function getIdDuenio()
    {
        return $this->idDuenio;
    }

    public function setIdDuenio($idDuenio)
    {
        $this->idDuenio = $idDuenio;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }
   
}