<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Config/Autoload.php';
require_once 'Config/Config.php';

use Config\Autoload as Autoload;
use Config\Router as Router;
use Config\Request as Request;

Autoload::Start();

session_start();

try{
    Router::Route(new Request());
}
catch(Exception $ex){
    require_once(VIEWS_PATH."error.php");
}

?>