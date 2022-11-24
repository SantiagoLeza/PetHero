<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use DAO\UserDAO as UserDAO;
use DAO\ArchivosDAO as ArchivosDAO;
use DAO\CiudadDAO as CiudadDAO;
use DAO\SolicitudCambioDAO as SolicitudCambioDAO;

use Controllers\MailController as MailController;

use DateTime;

class HomeController{

    private $guardianDAO;
    private $archivosDAO;
    private $ciudadDAO;
    private $solicitudDAO;
    private $userDAO;

    private $mailController;

    public function __construct(){
        try{
            $this->guardianDAO = new GuardianDAO();
            $this->archivosDAO = new ArchivosDAO();
            $this->ciudadDAO = new CiudadDAO();
            $this->solicitudDAO = new SolicitudCambioDAO();
            $this->userDAO = new UserDAO();

            $this->mailController = new MailController();
        }
        catch(Exception $ex){
            require_once(VIEWS_PATH."error.php");
        }
    }

    public function Index($message = ''){
        require_once(VIEWS_PATH."lobby.php");
    }

    public function Login($message = ''){
        require_once(VIEWS_PATH."login.php");
    }

    public function Signup(){
        try{
            $cityList = $this->ciudadDAO->GetAll();
            require_once(VIEWS_PATH."signup.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

    public function Home($message = null){
        if($message == 'Error'){
            $message = "Error: ha ocurrido un error. Intente nuevamente. Si el problema persiste contacte a un administrador.";
        }
        $guardianes = $this->guardianDAO->GetAll();
        require_once(VIEWS_PATH."home.php");
    }

    public function ShowGuardianList($fechaInicio = null, $fechaFin = null, $minStars = null, $maxStars = null, $minPrice = null, $maxPrice = null, $ubi = null)
    {
        try
        {
            $allGuardians = $this->guardianDAO->getAll();
            $guardians = array();

            if($fechaInicio == 'null'){
                $fechaInicio = null;
            }
            if($fechaFin == 'null'){
                $fechaFin = null;
            }
            if($minStars == 'null'){
                $minStars = 0;
            }
            if($maxStars == 'null'){
                $maxStars = 5;
            }
            if($minPrice == 'null'){
                $minPrice = 0;
            }
            if($maxPrice == 'null'){
                $maxPrice = null;
            }
            if($ubi == 'null'){
                $ubi = null;
            }

            foreach($allGuardians as $guardian){
                if($fechaInicio == null || $fechaInicio >= $guardian->getFechaInicio()){
                    if($fechaFin == null || $fechaFin <= $guardian->getFechaFin()){
                        if($guardian->getRating() >= $minStars && $guardian->getRating() <= $maxStars){
                            if($guardian->getPrecio() >= $minPrice && ($maxPrice == null || $guardian->getPrecio() <= $maxPrice)){
                                if($ubi == null || $guardian->getDireccionCuidado() == $ubi){
                                    array_push($guardians, $guardian);
                                }
                            }
                        }
                    }
                }
            }

            require_once(VIEWS_PATH."guardians-list.php");
        }
        catch(Exception $ex){
            $this->ShowErrorView($ex->getMessage());
            header("location: ".FRONT_ROOT."Home/Home");
        }
    }

    public function ShowGuardianInfo($id, $fechaInicio ='', $fechaFin = ''){
        try{
            $guardian = $this->guardianDAO->getById($id);
            require_once(VIEWS_PATH."guardian-info.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function ShowChangePassView(){
        require_once(VIEWS_PATH."req-change-pass.php");
    }

    public function generarSolicitudCambio($mail){
        try{
            $user = $this->userDAO->getByMail($mail);
            if($user != null){
                $soli = $this->solicitudDAO->add($user->getIdUsuario());
                $this->mailController->SendCambioContra($user->getMail(), $soli);
                header("location: ".FRONT_ROOT."Home/Login/LinkEnviado");
            }
            else{
                header("location: ".FRONT_ROOT."Home/Index/Error");
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

    public function ChangePassLand($idSolicitud){
        $solicitud = $this->solicitudDAO->getById($idSolicitud);

        if($solicitud != null && $this->checkSolicitud($solicitud)){
            $user = $this->userDAO->getById($solicitud['idUsuario']);
            $key = uniqid();
            $_SESSION['uuid'] = $key;
            header("location: ".FRONT_ROOT."Home/ShowChangePage/".$solicitud['idUsuario']."/".$solicitud['idSolicitudCambio']."/".$key);
        }
        else{
            header("location: ".FRONT_ROOT."Home/Index/LinkCaducado");
        }
    }

    public function ShowChangePage($idUser, $idSolicitud, $key){
        $user = $this->userDAO->getById($idUser);
        if($_SESSION['uuid'] == $key){
            $_SESSION['uuid'] = '';
            require_once(VIEWS_PATH."change-pass.php");
        }
        else{
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

    private function checkSolicitud($solicitud){
        $fecha = new DateTime($solicitud['fecha']);
        $fechaActual = new DateTime();
        
        $interval = $fecha->diff($fechaActual);
        if($interval->h > 2){
            return false;
        }
        if($solicitud['estado'] == 1){
            return false;
        }
        return true;
    }
}

?>
