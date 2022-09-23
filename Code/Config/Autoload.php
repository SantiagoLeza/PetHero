<?php

namespace Config;

class Autoload{
    public static function Start(){
        spl_autoload_register(function($class){
            include_once '../Models/' . $class . '.php';
        });
    }
}