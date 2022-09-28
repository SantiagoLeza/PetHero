<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

 class GuardianController{
    private $guardianDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
    }

    public function Home(){
        require_once(VIEWS_PATH."guardian-home.php");
    }

    public function ShowRegisterView(){
        require_once(VIEWS_PATH."register-guardian.php");
    }

    public function Add($initialDate, $finalDate, $tamanio, $address, $description){
        $user = $_SESSION['loggedUser'];
        $guardian = new Guardian($user->getMail(),
        $user->getPassword(), $user->getName(), $user->getPhoneNumber(), $user->getBirthdate(), $user->getAdress(), null, 0,  $initialDate, $finalDate, 0, implode('-', $tamanio), $address, $description);
        $this->guardianDAO->Add($guardian);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function actualizarFechas($fechaInicio, $fechaFin){
        $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
        $guardian->setFechaInicio($fechaInicio);
        $guardian->setFechaFin($fechaFin);
        $this->guardianDAO->Update($guardian);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    

 }

?>