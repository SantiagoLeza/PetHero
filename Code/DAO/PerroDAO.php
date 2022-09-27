<?php

namespace DAO;

use Models\Perro as Perro;

class PerroDAO{
    private $perroList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__)."/Data/perro.json";
    }

    public function Add(Perro $perro){
        $this->RetrieveData();
        array_push($this->perroList, $perro);
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->perroList;
    }

    public function GetByName($mail, $nombre){
        $this->RetrieveData();
        $perro = null;
        foreach($this->perroList as $perroL){
            if($perroL->getMailDuenio() == $mail && $perroL->getNombre() == $nombre){
                $perro = $perroL;
                break;
            }
        }
        return $perro;
    }

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->perroList as $perro){
            $valuesArray["mailDuenio"] = $perro->getMailDuenio();
            $valuesArray["nombre"] = $perro->getNombre();
            $valuesArray["tamanio"] = $perro->getTamanio();
            $valuesArray["raza"] = $perro->getRaza();
            $valuesArray["edad"] = $perro->getEdad();
            $valuesArray["sexo"] = $perro->getSexo();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData(){
        $this->perroList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray){
                $perro = new Perro($valuesArray["mailDuenio"], $valuesArray["nombre"], $valuesArray["tamanio"], $valuesArray["raza"], $valuesArray["edad"], $valuesArray["sexo"]);
                array_push($this->perroList, $perro);
            }
        }
    }

    private function Update(Perro $perro){
        $this->RetrieveData();
        $perroList = array();
        foreach($this->perroList as $perroL){
            if($perroL->getMailDuenio() == $perro->getMailDuenio() && $perroL->getNombre() == $perro->getNombre()){
                array_push($perroList, $perro);
            }else{
                array_push($perroList, $perroL);
            }
        }
        $this->perroList = $perroList;
        $this->SaveData();
    }
}