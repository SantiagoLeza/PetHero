<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

use DAO\PerroDAO as PerroDAO;
use Models\Perro as Perro;

class UserController{
    private $userDAO;
    private $perroDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->perroDAO = new PerroDAO();
    }

    public function ShowSignupView(){
        require_once(VIEWS_PATH."signup.php");
    }

    public function PetsView(){
        require_once(VIEWS_PATH."petsList.php");
    }

    public function AddDog($nombre, $tamanio, $raza, $edad, $sexo){
        $perro = new Perro($_SESSION['loggedUser']->getMail(), $nombre, $tamanio, $raza, $edad, $sexo);
        $this->perroDAO->Add($perro);
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