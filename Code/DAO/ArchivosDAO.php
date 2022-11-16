<?php

namespace DAO;

class ArchivosDAO{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function addImagenAnimal($url){
        try{

            $query3 = "SELECT 'idImagenAnimal, urlImagen' FROM ImagenAnimal WHERE urlImagen = :urlImagen";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query3, array(
                "urlImagen" => $url
            ));
            if($resultSet != null){
                return $resultSet[0]["idImagenAnimal"];
            }

            $query = "INSERT INTO ImagenAnimal (urlImagen) VALUES (:url)";
            $parameters["url"] = $url;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
            $query2 = "SELECT MAX(idImagenAnimal) AS id FROM ImagenAnimal";
            $resultSet = $this->connection->Execute($query2);
            return $resultSet[0]["id"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function addImagenVacunas($url){
        try{

            $query3 = "SELECT 'idCartaVacunacion, urlImagen' FROM CartaVacunacion WHERE urlImagen = :urlImagen";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query3, array(
                "urlImagen" => $url
            ));
            if($resultSet != null){
                return $resultSet[0]["idCartaVacunacion"];
            }

            $query = "INSERT INTO CartaVacunacion (urlImagen) VALUES (:url)";
            $parameters["url"] = $url;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
            $query2 = "SELECT MAX(idCartaVacunacion) AS id FROM CartaVacunacion";
            $resultSet = $this->connection->Execute($query2);
            return $resultSet[0]["id"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function addVideoAnimal($url){
        try{
            
            $query3 = "SELECT 'idVideoAnimal, urlVideo' FROM VideoAnimal WHERE urlVideo = :urlVideo";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query3, array(
                "urlVideo" => $url
            ));
            if($resultSet != null){
                return $resultSet[0]["idVideoAnimal"];
            }

            $query = "INSERT INTO VideoAnimal (urlVideo) VALUES (:url)";
            $parameters["url"] = $url;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
            $query2 = "SELECT MAX(idVideoAnimal) AS id FROM VideoAnimal";
            $resultSet = $this->connection->Execute($query2);
            return $resultSet[0]["id"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getImagenAnimal($id){
        try{
            $query = "SELECT urlImagen FROM ImagenAnimal WHERE idImagenAnimal = :id";
            $parameters["id"] = $id;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            return $resultSet[0]["urlImagen"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getImagenVacunas($id){
        try{
            $query = "SELECT urlImagen FROM CartaVacunacion WHERE idCartaVacunacion = :id";
            $parameters["id"] = $id;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            return $resultSet[0]["urlImagen"];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getVideoAnimal($id){
        try{
            $query = "SELECT urlVideo FROM VideoAnimal WHERE idVideoAnimal = :id";
            $parameters["id"] = $id;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            if($resultSet != null){
                return $resultSet[0]["urlVideo"];
            }
            return null;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }


}