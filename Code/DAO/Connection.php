<?php

namespace DAO;

use \PDO as PDO;
use \Exception as Exception;
use DAO\QueryType as QueryType;

class Connection{
    private $pdo = null;
    private $pdoStatement = null;
    private static $instance = null;

    private function __construct(){
        try{
            $dsn = sprintf('mysql:dbname=%s;host=%s', DB_NAME, DB_HOST);
            $this->pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function Execute($query, $parameters = array(), $queryType = QueryType::StoredProcedure){
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            $this->pdoStatement->execute();
            return $this->pdoStatement->fetchAll();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function ExecuteNonQuery($query, $parameters = array(), $queryType = QueryType::StoredProcedure){
        try{
            $this->Prepare($query);
            $this->BindParameters($parameters, $queryType);
            $this->pdoStatement->execute();
            return $this->pdoStatement->rowCount();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    private function Prepare($query){
        try{
            $this->pdoStatement = $this->pdo->prepare($query);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    private function BindParameters($parameters = array(), $queryType = QueryType::StoredProcedure){
        try{
            $i = 1;
            foreach($parameters as $key => $value){
                if($queryType == QueryType::Query){
                    $this->pdoStatement->bindValue($i, $value);
                }
                else{
                    $this->pdoStatement->bindValue(":" . $key, $value);
                }
                $i++;
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}