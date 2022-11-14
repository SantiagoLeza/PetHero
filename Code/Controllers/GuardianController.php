<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

use DAO\ReservaDAO as ReservaDAO;
use DAO\AnimalDAO as AnimalDAO;

class GuardianController{
    private $guardianDAO;
    private $reservasDAO;
    private $animalDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
        $this->reservasDAO = new ReservaDAO();
        $this->animalDAO = new AnimalDAO();
    }

    public function Home()
    {    
        try{
            $this->reservasDAO->checkReservas();
            $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
            $reservas = $this->reservasDAO->GetByIdGuardian($guardian->getIdGuardian());
            require_once(VIEWS_PATH."guardian-home.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function ShowRegisterView()
    {
        try
        {
            if($this->guardianDAO->isGuardian($_SESSION['loggedUser']->getIdUsuario()))
            {   
                header("location: ".FRONT_ROOT."Guardian/Home");    
            }
        }
       catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
        
    }

    public function Add($initialDate, $finalDate, $tamanio, $address, $description){
        try{
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
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function actualizarFechas($fechaInicio, $fechaFin){
        try{
            $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
            $this->guardianDAO->UpdateDates($guardian->getIdGuardian(), $fechaInicio, $fechaFin);
            echo $guardian->getIdGuardian();
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function actualizarPrecio($precio){
        try{
            $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
            $guardian->setPrecio($precio);
            $this->guardianDAO->UpdatePrecio($guardian->getIdGuardian(), $precio);
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function agregarDinero($dinero){
        try{
            $guardian = $this->guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
            $guardian->setSaldo($dinero + $guardian->getSaldo());
            $this->guardianDAO->UpdateSaldo($guardian->getIdGuardian(), $guardian->getSaldo());
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function AceptarReserva($idReserva){
        try{
            $this->reservasDAO->AceptarReserva($idReserva);
            $reserva = $this->reservasDAO->getById($idReserva);
            $this->agregarDinero(($reserva->getPrecio()* $reserva->getDias())*0.5);
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function RechazarReserva($idReserva){
        try{
            $this->reservasDAO->RechazarReserva($idReserva);
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function CancelarReserva($idReserva){
        try{
            $this->reservasDAO->CancelarReserva($idReserva);
            header("location: ".FRONT_ROOT."Guardian/Home");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

 }

?>