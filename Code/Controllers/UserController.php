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

use DAO\SolicitudCambioDAO as SolicitudCambioDAO;

use Controllers\MailController as MailController;

class UserController{
    private $userDAO;
    private $AnimalDAO;
    private $guardianDAO;
    private $reservaDAO;
    private $ciudadDAO;
    private $solicitudDAO;
    
    private $mailController;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->AnimalDAO = new AnimalDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->reservaDAO = new ReservaDAO();
        $this->archivosDAO = new ArchivosDAO();
        $this->ciudadDAO = new CiudadDAO();
        $this->solicitudDAO = new SolicitudCambioDAO();

        $this->mailController = new MailController();
    }

    public function ShowSignupView(){
        try{
            $cityList = $this->ciudadDAO->GetAll();
            require_once(VIEWS_PATH."signup.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

    public function PetsView(){
        try
        {
            $pets = $this->AnimalDAO->GetAnimalesPorUsuario($_SESSION['loggedUser']->getIdUsuario());
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

            if ($uploadOk == 1) {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $file["name"];
                } else {
                    return $file["name"];
                }
            }

            
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
            header("location: ".FRONT_ROOT."Home/Index/Error");
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
                if($this->userDAO->GetByMail($mail) == null)
                {
                    if($this->userDAO->getByPhoneNumber($phoneNumber) == null)
                    {
                        if($password == $repeatPassword)
                        {
                            $this->Add($mail, $password, $name, $lastname, $phoneNumber, $birthDate, $city, $adress);
                            $_SESSION["loggedUser"] = $this->userDAO->GetByMail($mail);
                            header("location: ".FRONT_ROOT."Home/Home");
                        }
                        else
                        {
                            $message = "Las contraseñas no coinciden";
                            require_once(VIEWS_PATH."signup.php");
                        }
                    }
                    else
                    {
                        $message = "El numero de telefono ya existe";
                        require_once(VIEWS_PATH."signup.php");
                    }
                }
                else
                {
                    $message = "El usuario ya existe";
                    require_once(VIEWS_PATH."signup.php");
                }
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

    public function Reservar($fechaInicio, $fechaFin, $idAnimal, $idGuardian, $precio){
        
        try{
            $guardian = $this->guardianDAO->GetById($idGuardian);
            $animal = $this->AnimalDAO->getAnimalByID($idAnimal);

            $estadoGuardian = $this->guardianDAO->GetEstadoGuardian($idGuardian, $fechaInicio, $fechaFin, $animal->getRaza(), $animal->getTamanio(), $idAnimal);

            if($estadoGuardian == 'OK'){
                $this->reservaDAO->Add($idGuardian, $idAnimal, $fechaInicio, $fechaFin, $precio, 'Pendiente');
                header("location: ".FRONT_ROOT."Home/Home/ReservaExitosa");
            }
            else{
                require_once(VIEWS_PATH."guardian-info.php");
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function ReservasView(){
        try{
            $reservas = $this->reservaDAO->GetAllByUser($_SESSION['loggedUser']->getIdUsuario());
            require_once(VIEWS_PATH."reservas.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function ShowPagar($idReserva){
        try{
            $reserva = $this->reservaDAO->GetById($idReserva);
            require_once(VIEWS_PATH."pagar-reserva.php");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function PagarReserva($idReserva, $numeroTarjeta, $fechaVencimiento, $nombreTitular, $cvv, $monto){
        try{

            $this->reservaDAO->PagarReserva($idReserva, $numeroTarjeta, $fechaVencimiento, $nombreTitular, $cvv, $monto);

            $this->guardianDAO->AddSaldo(
                $this->reservaDAO->GetById($idReserva)->getIdGuardian(),
                $this->reservaDAO->GetById($idReserva)->getPrecioTotal() * 0.5
            );

            $factura = $this->reservaDAO->getFacturaById($idReserva);
            $reservation = $this->reservaDAO->getById($idReserva);
            $nombreMascota = $this->AnimalDAO->getAnimalByID($reservation->getIdAnimal())->getNombre();

            $this->mailController->SendCupon(
                $_SESSION['loggedUser']->getMail(),
                $factura['fecha'],
                $factura['razonSocial'],
                $monto,
                $reservation->getFechaInicio(),
                $reservation->getFechaFin(),
                $nombreMascota
            );
            header("location: ".FRONT_ROOT."User/ReservasView");
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Home/Error");
        }
    }

    public function PetInfo($id)
    {
        $Animal = $this->AnimalDAO->getAnimalByID($id);
        require_once(VIEWS_PATH."pet-info.php");
    }

    public function ChangePass($idUsuario, $idSolicitud, $pass1, $pass2){
        try{
            if($pass1 == $pass2){
                $this->userDAO->changePassword($idUsuario, $pass1);
                $this->solicitudDAO->cambiarEstado($idSolicitud);
                header("location: ".FRONT_ROOT."Home/Login/PasswordChanged");
            }
            else{
                $message = "Las contraseñas no coinciden";
                require_once(VIEWS_PATH."change-pass.php");
            }
        }
        catch(Exception $ex){
            header("location: ".FRONT_ROOT."Home/Index/Error");
        }
    }

}