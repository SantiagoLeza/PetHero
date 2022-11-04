<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

 class GuardianController{
    private $guardianDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
    }

    public function Home()
    {    
        require_once(VIEWS_PATH."guardian-home.php");
    }

    public function ShowRegisterView(){
        if($this->guardianDAO->isGuardian($_SESSION['loggedUser']->getIdUsuario())){
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        else
        {
            require_once(VIEWS_PATH."register-guardian.php");
        }
    }

    public function Add($initialDate, $finalDate, $tamanio, $address, $description){
        $tamanios = implode(", ", $tamanio);
        $user = $_SESSION['loggedUser'];
        $this->guardianDAO->Add(
            $user->getIdUsuario(),
            $initialDate,
            $finalDate,
            $tamanios,
            $address,
            $description
        );
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