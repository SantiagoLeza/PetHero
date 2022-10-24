<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

use DAO\AnimalDAO as AnimalDAO;
use Models\Animal as Animal;

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

    public function AddAnimal($tipo, $nombre, $tamanio, $raza, $edad, $sexo){
        $Animal = new Animal($_SESSION['loggedUser']->getMail(), $tipo, $nombre, $tamanio, $raza, $edad, $sexo);
        $this->AnimalDAO->Add($Animal);
        header("location: ".FRONT_ROOT."User/PetsView");
    }

    public function Add($mail, $password, $name, $phoneNumber, $birthDate, $adress){
        $user = new User($mail, $password, $name, $phoneNumber, $birthDate, $adress, array());
        $this->userDAO->Add($user);
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

    public function Signup($mail, $password, $repeatPassword, $name, $phoneNumber, $birthDate, $adress){
        $userDAO = new UserDAO();
        if($birthDate > date("Y-m-d")){
            $message = "Fecha de nacimiento invalida";
            require_once(VIEWS_PATH."signup.php");
        }
        else{
            if($userDAO->GetByMail($mail) == null){
                if($password == $repeatPassword){
                    $this->Add($mail, $password, $name, $phoneNumber, $birthDate, $adress);
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