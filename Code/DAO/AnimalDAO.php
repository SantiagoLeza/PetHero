<?php

namespace DAO;

use Models\Animal as Animal;

class AnimalDAO{
    private $AnimalList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__)."/Data/Animal.json";
    }

    public function Add(Animal $Animal){
        $this->RetrieveData();
        array_push($this->AnimalList, $Animal);
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->AnimalList;
    }

    public function GetByName($mail, $nombre){
        $this->RetrieveData();
        $Animal = null;
        foreach($this->AnimalList as $AnimalL){
            if($AnimalL->getMailDuenio() == $mail && $AnimalL->getNombre() == $nombre){
                $Animal = $AnimalL;
                break;
            }
        }
        return $Animal;
    }

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->AnimalList as $Animal){
            $valuesArray["mailDuenio"] = $Animal->getMailDuenio();
            $valuesArray["tipo"] = $Animal->getTipo();
            $valuesArray["nombre"] = $Animal->getNombre();
            $valuesArray["tamanio"] = $Animal->getTamanio();
            $valuesArray["raza"] = $Animal->getRaza();
            $valuesArray["edad"] = $Animal->getEdad();
            $valuesArray["sexo"] = $Animal->getSexo();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData(){
        $this->AnimalList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray){
                $Animal = new Animal($valuesArray["mailDuenio"],$valuesArray["tipo"],  $valuesArray["nombre"], $valuesArray["tamanio"], $valuesArray["raza"], $valuesArray["edad"], $valuesArray["sexo"]);
                array_push($this->AnimalList, $Animal);
            }
        }
    }

    private function Update(Animal $Animal){
        $this->RetrieveData();
        $AnimalList = array();
        foreach($this->AnimalList as $AnimalL){
            if($AnimalL->getMailDuenio() == $Animal->getMailDuenio() && $AnimalL->getNombre() == $Animal->getNombre()){
                array_push($AnimalList, $Animal);
            }else{
                array_push($AnimalList, $AnimalL);
            }
        }
        $this->AnimalList = $AnimalList;
        $this->SaveData();
    }
}