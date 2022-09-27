<?php

namespace Controllers;

class HomeController{

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

}

?>
