<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;
use DAO\ArchivosDAO as ArchivosDAO;
use DAO\CiudadDAO as CiudadDAO;

class HomeController{

    private $guardianDAO;
    private $archivosDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
        $this->archivosDAO = new ArchivosDAO();
        $this->ciudadDAO = new CiudadDAO();
    }

    public function Index(){
        require_once(VIEWS_PATH."lobby.php");
    }

    public function Login(){
        require_once(VIEWS_PATH."login.php");
    }

    public function Signup(){
        try{
            $cityList = $this->ciudadDAO->GetAll();
            require_once(VIEWS_PATH."signup.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function Home($error = null){
        if($error != null){
            $error = "Error: ha ocurrido un error. Intente nuevamente. Si el problema persiste contacte a un administrador.";
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
}

?>
