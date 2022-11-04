<?php

namespace Models;

use DAO\AnimalDAO as AnimalDAO;

class User{
    private $idUsuario;
    private $mail;
    private $password;
    private $name;
    private $surname;
    private $phoneNumber;
    private $birthdate;
    private $idCiudad;
    private $direccion;

    public function __construct($idUsuario, $mail, $password, $name, $surname, $phoneNumber, $birthdate, $idCiudad, $direccion)
    {
        $this->idUsuario = $idUsuario;
        $this->mail = $mail;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phoneNumber = $phoneNumber;
        $this->birthdate = $birthdate;
        $this->idCiudad = $idCiudad;
        $this->direccion = $direccion;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getIdCiudad()
    {
        return $this->idCiudad;
    }

    public function setIdCiudad($idCiudad)
    {
        $this->idCiudad = $idCiudad;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getMascotas(){
        $animalDAO = new AnimalDAO();
        $pets = $animalDAO->GetAnimalesPorUsuario($this->idUsuario);
        return $pets;
    }
    
}