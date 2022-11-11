<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

use DAO\ReservaDAO as ReservaDAO;
use DAO\AnimalDAO as AnimalDAO;

class GuardianController{
    private $guardianDAO;
    private $reservasDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
        $this->reservasDAO = new ReservaDAO();
    }

    public function Home()
    {    
        $this->reservasDAO->checkReservas();
        $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
        $reservas = $this->reservasDAO->GetByIdGuardian($guardian->getIdGuardian());
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
        $this->guardianDAO->UpdateDates($guardian->getIdGuardian(), $fechaInicio, $fechaFin);
        echo $guardian->getIdGuardian();
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function actualizarPrecio($precio){
        $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
        $guardian->setPrecio($precio);
        $this->guardianDAO->UpdatePrecio($guardian->getIdGuardian(), $precio);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function agregarDinero($dinero){
        $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
        $guardian->setSaldo($dinero);
        $this->guardianDAO->UpdateSaldo($guardian->getIdGuardian(), $dinero);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function AceptarReserva($idReserva){
        $this->reservasDAO->AceptarReserva($idReserva);
        $this->agregarDinero($this->reservasDAO->getById($idReserva)->getPrecio()*0.5);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function RechazarReserva($idReserva){
        $this->reservasDAO->RechazarReserva($idReserva);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

    public function CancelarReserva($idReserva){
        $this->reservasDAO->CancelarReserva($idReserva);
        header("location: ".FRONT_ROOT."Guardian/Home");
    }

 }

?>