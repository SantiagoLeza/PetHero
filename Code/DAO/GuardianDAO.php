<?php

namespace DAO;

use Models\Guardian as Guardian;

class GuardianDAO{
    private $guardianList = array();
    private $filename;

    public function __construct(){
        $this->fileName = dirname(__DIR__)."/Data/guardian.json";
    }

    public function Add(Guardian $guardian){
        $this->retrieveData();
        array_push($this->guardianList, $guardian);
        $this->saveData();
    }

    public function getAll(){
        $this->retrieveData();
        return $this->guardianList;
    }

    public function getGuardianByMail($mail){
        $this->retrieveData();
        $guardian = null;
        foreach($this->guardianList as $guardianL){
            if($guardianL->getMail() == $mail){
                $guardian = $guardianL;
                break;
            }
        }
        return $guardian;
    }

    private function SaveData(){
        $arrayToEncode = array();
        
        foreach($this->guardianList as $guardian){
            $valuesArray["mail"] = $guardian->getMail();
            $valuesArray["password"] = $guardian->getPassword();
            $valuesArray["name"] = $guardian->getName();
            $valuesArray["phoneNumber"] = $guardian->getPhoneNumber();
            $valuesArray["birthdate"] = $guardian->getBirthdate();
            $valuesArray["adress"] = $guardian->getAdress();
            $valuesArray["dogs"] = $guardian->getDogs();
            $valuesArray["rating"] = $guardian->getRating();
            $valuesArray["fechaInicio"] = $guardian->getFechaInicio();
            $valuesArray["fechaFin"] = $guardian->getFechaFin();
            $valuesArray["saldo"] = $guardian->getSaldo();
            $valuesArray["tamanio"] = $guardian->getTamanio();
            $valuesArray["direccionCuidado"] = $guardian->getDireccionCuidado();
            $valuesArray["descripcion"] = $guardian->getDescripcion();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData(){
        $this->guardianList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray){
                $guardian = new Guardian($valuesArray["mail"], $valuesArray["password"], $valuesArray["name"], $valuesArray["phoneNumber"], $valuesArray["birthdate"], $valuesArray["adress"], $valuesArray["dogs"], $valuesArray["rating"], $valuesArray["fechaInicio"], $valuesArray["fechaFin"], $valuesArray["saldo"], $valuesArray["tamanio"], $valuesArray["direccionCuidado"], $valuesArray["descripcion"]);
                array_push($this->guardianList, $guardian);
            }
        }
    }

    public function Update(Guardian $guardian){
        $this->RetrieveData();
        $guardianList = array();
        foreach($this->guardianList as $value){
            if($value->getMail() == $guardian->getMail()){
                array_push($guardianList, $guardian);
            }else{
                array_push($guardianList, $value);
            }
        }
        $this->guardianList = $guardianList;
        $this->SaveData();
    }

    public function isGuardian($mail){
        $this->retrieveData();
        $isGuardian = false;
        foreach($this->guardianList as $guardian){
            if($guardian->getMail() == $mail){
                $isGuardian = true;
                break;
            }
        }
        return $isGuardian;
    }

    public function getByMail($mail){
        $this->retrieveData();
        $guardian = null;
        foreach($this->guardianList as $guardianL){
            if($guardianL->getMail() == $mail){
                $guardian = $guardianL;
                break;
            }
        }
        return $guardian;
    }
}
?>