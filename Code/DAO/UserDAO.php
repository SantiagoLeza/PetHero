<?php

namespace DAO;

use Models\User as User;
use DAO\Connection as Connection;
use DAO\CiudadDAO as CiudadDAO;

class UserDAO{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function Add($name, $lastName, $email, $password, $phone, $address, $city, $birthdate){
        $query = "INSERT INTO Usuarios (nombre, apellido, mail, contrasenia, numeroTelefono, direccion, idCiudad, fechaDeNacimiento) VALUES (:name, :lastName, :email, :password, :phone, :address, :idCiudad, :birthdate);";

        $ciudadDAO = new CiudadDAO();
        $idCiudad = $ciudadDAO->getCiudadByName($city)['idCiudades'];

        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "name" => $name,
                "lastName" => $lastName,
                "email" => $email,
                "password" => $password,
                "phone" => $phone,
                "address" => $address,
                "idCiudad" => $idCiudad,
                "birthdate" => $birthdate
            ));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    

    public function GetAll(){
        try{
            $ciudadDAO = new CiudadDAO();
            $userList = array();
            $query = "SELECT * FROM Usuarios";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $user = new User(
                    $row["idUsuario"],
                    $row["mail"],
                    $row["contrasenia"],
                    $row["nombre"],
                    $row["apellido"],
                    $row["numeroTelefono"],
                    $row["fechaDeNacimiento"],
                    $resultSet[0]["idCiudad"],
                $resultSet[0]["direccion"]
                );
                array_push($userList, $user);
            }
            return $userList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByMail($email){
        try{
            $ciudadDAO = new CiudadDAO();
            $query = "SELECT * FROM Usuarios WHERE mail = :email";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("email" => $email));
            if(count($resultSet) == 0){
                return null;
            }
            $user = new User(
                $resultSet[0]["idUsuario"],
                $resultSet[0]["mail"],
                $resultSet[0]["contrasenia"],
                $resultSet[0]["nombre"],
                $resultSet[0]["apellido"],
                $resultSet[0]["numeroTelefono"],
                $resultSet[0]["fechaDeNacimiento"],
                $resultSet[0]["idCiudad"],
                $resultSet[0]["direccion"]
            );
            return $user;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getById($id){
        try{
            $ciudadDAO = new CiudadDAO();
            $query = "SELECT * FROM Usuarios WHERE idUsuario = :id";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("id" => $id));
            if(count($resultSet) == 0){
                return null;
            }
            $user = new User(
                $resultSet[0]["idUsuario"],
                $resultSet[0]["mail"],
                $resultSet[0]["contrasenia"],
                $resultSet[0]["nombre"],
                $resultSet[0]["apellido"],
                $resultSet[0]["numeroTelefono"],
                $resultSet[0]["fechaDeNacimiento"],
                $resultSet[0]["idCiudad"],
                $resultSet[0]["direccion"]
            );
            return $user;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}