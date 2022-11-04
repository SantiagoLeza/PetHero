<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

use DAO\AnimalDAO as AnimalDAO;
use Models\Animal as Animal;

use DAO\ArchivosDAO as ArchivosDAO;

use DAO\Connection as Connection;

class UserController{
    private $userDAO;
    private $AnimalDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->AnimalDAO = new AnimalDAO();
    }

    public function ShowSignupView(){
        require_once(VIEWS_PATH."signup.php");
    }

    public function PetsView(){
        require_once(VIEWS_PATH."petsList.php");
    }

    private function saveFile($file, $type, $nombre, $edad){
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
        
        if ($uploadOk == 0) {
            echo "<script>alert('Error al subir la imagen.');</script>";
        } else {
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        return $file["name"];
    }

    public function AddAnimal($raza, $nombre, $edad, $sexo, $imagenAnimal, $imagenCarta, $video = '', $observaciones=''){

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

    public function Add($mail, $password, $name, $lastname, $phoneNumber, $birthDate, $city, $adress){
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

    public function Login($mail, $password){
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

    public function ShowLoginView(){
        require_once(VIEWS_PATH."login.php");
    }

    public function Logout(){
        session_destroy();
       header("location: ".FRONT_ROOT."User/ShowLoginView");
    }

    public function Signup($mail, $password, $repeatPassword, $name, $lastname,$phoneNumber, $birthDate, $adress, $city){
        $userDAO = new UserDAO();
        if($birthDate > date("Y-m-d")){
            $message = "Fecha de nacimiento invalida";
            require_once(VIEWS_PATH."signup.php");
        }
        else{
            if($userDAO->GetByMail($mail) == null){
                if($password == $repeatPassword){
                    $this->Add($mail, $password, $name, $lastname, $phoneNumber, $birthDate, $city, $adress);
                    $_SESSION["loggedUser"] = $userDAO->GetByMail($mail);
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



}