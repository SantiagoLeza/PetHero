<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

class UserController{
    private $userDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
    }

    public function ShowSignupView(){
        require_once(VIEWS_PATH."signup.php");
    }

    public function Add($mail, $password, $name, $phoneNumber, $birthDate, $adress){
        $user = new User($mail, $password, $name, $phoneNumber, $birthDate, $adress);
        $this->userDAO->Add($user);
        $this->ShowLoginView();
    }

    public function Login($mail, $password){
        $user = $this->userDAO->GetByMail($mail);
        if($user != null){
            if($user->getPassword() == $password){
                $_SESSION["loggedUser"] = $user;
                header("location: ".FRONT_ROOT."Home/Index");
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
                header("location: ".FRONT_ROOT."User/ShowLoginView");
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