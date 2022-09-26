<?php

namespace DAO;

use Models\User as User;

class UserDAO{
    private $userList = array();
    private $fileName;

    public function __construct(){
        $this->fileName = dirname(__DIR__)."/Data/user.json";
    }

    public function Add(User $user){
        $this->RetrieveData();
        array_push($this->userList, $user);
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->userList;
    }

    public function GetByMail($mail){
        $this->RetrieveData();
        $user = null;
        foreach($this->userList as $userL){
            if($userL->getMail() == $mail){
                $user = $userL;
                break;
            }
        }
        return $user;
    }

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->userList as $user){
            $valuesArray["mail"] = $user->getMail();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["name"] = $user->getName();
            $valuesArray["phoneNumber"] = $user->getPhoneNumber();
            $valuesArray["birthdate"] = $user->getBirthdate();
            $valuesArray["adress"] = $user->getAdress();
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData(){
        $this->userList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray){
                $user = new User($valuesArray["mail"], $valuesArray["password"], $valuesArray["name"], $valuesArray["phoneNumber"], $valuesArray["birthdate"], $valuesArray["adress"]);
                array_push($this->userList, $user);
            }
        }
    }

    public function Update(User $user){
        $this->RetrieveData();
        $userList = array();
        foreach($this->userList as $value){
            if($value->getMail() == $user->getMail()){
                array_push($userList, $user);
            }else{
                array_push($userList, $value);
            }
        }
        $this->userList = $userList;
        $this->SaveData();
    }
}