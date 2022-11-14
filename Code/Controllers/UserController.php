<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

use DAO\AnimalDAO as AnimalDAO;
use Models\Animal as Animal;

use DAO\ArchivosDAO as ArchivosDAO;

use DAO\Connection as Connection;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

use DAO\ReservaDAO as ReservaDAO;
use Models\Reserva as Reserva;

use DAO\CiudadDAO as CiudadDAO;

class UserController{
    private $userDAO;
    private $AnimalDAO;
    private $guardianDAO;
    private $reservaDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->AnimalDAO = new AnimalDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->reservaDAO = new ReservaDAO();
        $this->archivosDAO = new ArchivosDAO();
        $this->ciudadDAO = new CiudadDAO();
    }

    public function ShowSignupView(){
        try{
            $cityList = $this->ciudadDAO->GetAll();
            require_once(VIEWS_PATH."signup.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function PetsView(){
        try
        {
            $pets = $this->AnimalDAO->getAll();
            $user = $this->userDAO->getById($_SESSION['loggedUser']->getIdUsuario());
            require_once(VIEWS_PATH."petsList.php");
        }
        catch(Exception $ex)
        {
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    private function saveFile($file, $type, $nombre, $edad){
        try{
            $fileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            $file["name"] = $_SESSION["loggedUser"]->getMail()."_".$nombre."_".$edad.".".$fileType;
            $target_dir = ROOT."Data/".$type.'/';
            $target_file = $target_dir . basename($file["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(isset($_POST["submit"])) {
                $check = getimagesize($file["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                unlink($target_file);
            }

            return $file["name"];
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function AddAnimal($raza, $nombre, $edad, $sexo, $imagenAnimal, $imagenCarta, $video = '', $observaciones=''){

        try
        {
            $archivoDAO = new ArchivosDAO();

            $idImagenPerfil = $archivoDAO->addImagenAnimal($this->saveFile($imagenAnimal, "ImagenAnimal", $nombre, $edad));
            $idCartaVacunacion = $archivoDAO->addImagenVacunas($this->saveFile($imagenCarta, "ImagenVacunas", $nombre, $edad));
            if($video['name'] != ''){
                $idVideo = $archivoDAO->addVideoAnimal($this->saveFile($video, "VideoAnimal", $nombre, $edad));
            }


            $idTipoAnimal = $this->AnimalDAO->getIdAnimalXRaza($raza);
            $this->AnimalDAO->Add(
                $idTipoAnimal,
                $nombre,
                $edad,
                $sexo,
                $idImagenPerfil,
                $idCartaVacunacion,
                $_SESSION['loggedUser']->getIdUsuario(),
                $observaciones,
                $idVideo
            );
            header("location: ".FRONT_ROOT."User/PetsView");
        }
        catch(Exception $ex)
        {
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function Add($mail, $password, $name, $lastname, $phoneNumber, $birthDate, $city, $adress){
        try{
            $this->userDAO->Add(
                $name,
                $lastname,
                $mail,
                $password,
                $phoneNumber,
                $adress,
                $city,
                $birthDate
            );
            $this->ShowLoginView();
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function Login($mail, $password){
        try{
            $user = $this->userDAO->GetByMail($mail);
            if($user != null){
                if($user->getPassword() == $password){
                    $_SESSION["loggedUser"] = $user;
                    header("location: ".FRONT_ROOT."Home/Home");
                }
                else{
                    $message = "Contraseña incorrecta";
                    require_once(VIEWS_PATH."login.php");
                }
            }
            else{
                $message = "Usuario inexistente";
                require_once(VIEWS_PATH."login.php");
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function ShowLoginView(){
        require_once(VIEWS_PATH."login.php");
    }

    public function Logout(){
        session_destroy();
        header("location: ".FRONT_ROOT."User/ShowLoginView");
    }

    public function Signup($mail, $password, $repeatPassword, $name, $lastname,$phoneNumber, $birthDate, $adress, $city){
        try{
            if($birthDate > date("Y-m-d")){
                $message = "Fecha de nacimiento invalida";
                require_once(VIEWS_PATH."signup.php");
            }
            else{
                if($this->userDAO->GetByMail($mail) == null){
                    if($password == $repeatPassword){
                        $this->Add($mail, $password, $name, $lastname, $phoneNumber, $birthDate, $city, $adress);
                        $_SESSION["loggedUser"] = $this->userDAO->GetByMail($mail);
                        header("location: ".FRONT_ROOT."Home/Home");
                    }
                    else{
                        $message = "Las contraseñas no coinciden";
                        require_once(VIEWS_PATH."signup.php");
                    }
                }
                else{
                    $message = "El usuario ya existe";
                    require_once(VIEWS_PATH."signup.php");
                }
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function Reservar($fechaInicio, $fechaFin, $idAnimal, $idGuardian, $precio){
        
        try{
            $guardian = $this->guardianDAO->GetById($idGuardian);
            $animal = $this->AnimalDAO->getAnimalByID($idAnimal);

            $estadoGuardian = $this->guardianDAO->GetEstadoGuardian($idGuardian, $fechaInicio, $fechaFin, $animal->getRaza(), $animal->getTamanio(), $idAnimal);
            if($estadoGuardian == 'OK'){
                $this->reservaDAO->Add($idGuardian, $idAnimal, $fechaInicio, $fechaFin, $precio, 'Pendiente');
                header("location: ".FRONT_ROOT."Home/Home");
            }
            else{
                $message = $estadoGuardian;
                require_once(VIEWS_PATH."guardian-info.php");
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

}