<?php

namespace Config;

class Request{
    private $controller;
    private $method;
    private $parameters = array();

    public function __construct(){
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        $urlToArray = explode("/", $url);
        $urlToArray = array_filter($urlToArray);

        if(empty($urlToArray)){
            $this->controller = 'Home';
        }else{
            $this->controller = ucwords(array_shift($urlToArray));
        }

        if(empty($urlToArray)){
            $this->method = 'Index';
        }else{
            $this->method = array_shift($urlToArray);
        }

        $this->parameters = $urlToArray;
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getParameters(){
        return $this->parameters;
    }
}