<?php

namespace Controllers;

use DAO\GuardianDAO as GuardianDAO;

class HomeController{

    private $guardianDAO;

    public function __construct(){
        $this->guardianDAO = new GuardianDAO();
    }

    public function Index(){
        require_once(VIEWS_PATH."lobby.php");
    }

    public function Login(){
        require_once(VIEWS_PATH."login.php");
    }

    public function Signup(){
        require_once(VIEWS_PATH."signup.php");
    }

    public function Home(){
        require_once(VIEWS_PATH."home.php");
    }

    public function ShowGuardianList($fechaInicio = null, $fechaFin = null, $minStars = null, $maxStars = null, $minPrice = null, $maxPrice = null, $ubi = null){
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
}

?>
