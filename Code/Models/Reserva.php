<?php

namespace Models;

class Reserva
{
    private $idReserva;
    private $idGuardian;
    private $idAnimal;
    private $fechaInicio;
    private $fechaFin;
    private $precio;
    private $estado;
    
    public function __construct($idReserva, $idGuardian, $idAnimal, $fechaInicio, $fechaFin, $precio, $estado)
    {
        $this->idReserva = $idReserva;
        $this->idGuardian = $idGuardian;
        $this->idAnimal = $idAnimal;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->precio = $precio;
        $this->estado = $estado;
    }

    public function getIdReserva()
    {
        return $this->idReserva;
    }

    public function setIdReserva($idReserva)
    {
        $this->idReserva = $idReserva;
    }

    public function getIdGuardian()
    {
        return $this->idGuardian;
    }

    public function setIdGuardian($idGuardian)
    {
        $this->idGuardian = $idGuardian;
    }

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getDias(){
        $fecha1 = new \DateTime($this->getFechaInicio());
        $fecha2 = new \DateTime($this->getFechaFin());
        $dias = $fecha1->diff($fecha2);
        return $dias->days;
    }
}



?>