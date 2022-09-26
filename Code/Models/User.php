<?php

namespace Models;

class User{
    private $mail;
    private $password;
    private $name;
    private $phoneNumber;
    private $birthdate;
    private $adress;
    
    public function __construct($mail, $password, $name, $phoneNumber, $birthdate, $adress){
        $this->mail = $mail;
        $this->password = $password;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->birthdate = $birthdate;
        $this->adress = $adress;
    }

    public function getMail(){
        return $this->mail;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }

    public function getAdress(){
        return $this->adress;
    }

    public function setAdress($adress){
        $this->adress = $adress;
    }

    
}