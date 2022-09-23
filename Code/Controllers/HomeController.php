<?php

namespace Controllers;

class HomeController{

    public function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    public function Login(){
        require_once(VIEWS_PATH."login.php");
    }

}

?>
