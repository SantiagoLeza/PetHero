<?php

namespace DAO;

use Models\Animal as Animal;

use DAO\Connection as Connection;
use DAO\ArchivosDAO as ArchivosDAO;

class AnimalDAO{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function Add($idTipoAnimal, $nombre, $edad, $sexo, $idImagenPerfil, $idCartaVacunacion, $idUsuario, $observaciones, $idVideo = null){

        $query = "INSERT INTO Animales (idTipoAnimal, nombre, edad, sexo, idImagenPerfil, idVideo, idCartaVacunacion, idDuenio, observaciones) VALUES (:idTipoAnimal, :nombre, :edad, :sexo, :idImagenPerfil, :idVideo, :idCartaVacunacion, :idDuenio, :observaciones);";
        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "idTipoAnimal" => $idTipoAnimal,
                "nombre" => $nombre,
                "edad" => $edad,
                "sexo" => $sexo,
                "idImagenPerfil" => $idImagenPerfil,
                "idVideo" => $idVideo,
                "idCartaVacunacion" => $idCartaVacunacion,
                "idDuenio" => $idUsuario,
                "observaciones" => $observaciones
            ));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAll(){
        try{
            $animalList = array();
            $query = "SELECT * FROM Animales as a join TipoAnimal as ta
            on a.idTipoAnimal = ta.idTipoAnimal";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $animal = new Animal(
                    $row["idAnimales"],
                    $row["tipo"],
                    $row["raza"],
                    $row["tamanio"],
                    $row["nombre"],
                    $row["edad"],
                    $row["sexo"],
                    $row["idImagenPerfil"],
                    $row["idVideo"],
                    $row["idCartaVacunacion"],
                    $row["idDuenio"],
                    $row["observaciones"]
                );
                array_push($animalList, $animal);
            }
            return $animalList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetRazas(){
        try{
            $razaList = array();
            $query = "SELECT * FROM TipoAnimal";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                array_push($razaList, array(
                    "tipo" => $row["tipo"],
                    "raza" => $row["raza"]
                ));
            }
            return $razaList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getIdAnimalXRaza($raza){
        try{
            $query = "SELECT idTipoAnimal FROM TipoAnimal WHERE raza = :raza";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("raza" => $raza));
            return $resultSet[0]["idTipoAnimal"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAnimalesPorUsuario($idUsuario){
        try{
            $animalList = array();
            $query = "SELECT * FROM Animales as a join TipoAnimal as ta
            on a.idTipoAnimal = ta.idTipoAnimal WHERE idDuenio = :idUsuario";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("idUsuario" => $idUsuario));
            foreach($resultSet as $row){
                $animal = new Animal(
                    $row["idAnimales"],
                    $row["tipo"],
                    $row["raza"],
                    $row["tamanio"],
                    $row["nombre"],
                    $row["edad"],
                    $row["sexo"],
                    $row["idImagenPerfil"],
                    $row["idVideo"],
                    $row["idCartaVacunacion"],
                    $row["idDuenio"],
                    $row["observaciones"]
                );
                array_push($animalList, $animal);
            }
        }
        catch(Exception $ex){
            throw $ex;
        }

        return $animalList;
    }
}