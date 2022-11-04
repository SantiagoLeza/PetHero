<?php

namespace DAO;

class CiudadDAO{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function GetAll(){
        try{
            $cityList = array();
            $query = "SELECT * FROM Ciudades";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $city = array(
                    "idCiudad" => $row["idCiudades"],
                    "nombre" => $row["nombre"]
                );
                array_push($cityList, $city);
            }
            return $cityList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getCiudadByName($name){
        try{
            $query = "SELECT * FROM Ciudades WHERE nombre = :name";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("name" => $name));
            $city = array(
                "idCiudades" => $resultSet[0]['idCiudades'],
                "nombre" => $resultSet[0]['nombre']
            );
            return $city;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getCiudadById($id){
        try{
            $query = "SELECT * FROM Ciudades WHERE idCiudades = :id";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("id" => $id));
            $city = array(
                "id" => $resultSet[0]["idCiudad"],
                "name" => $resultSet[0]["nombre"]
            );
            return $city;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}