<?php

namespace DAO;

class SolicitudCambioDAO{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function add($idUsuario){
        $query = "INSERT INTO SolicitudCambio (idUsuario, fecha, estado) VALUES (:idUsuario, now(), 0);";

        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "idUsuario" => $idUsuario 
            ));
            $query2 = "SELECT LAST_INSERT_ID() as id";
            $result = $connection->Execute($query2);
            $soli = $this->getById($result[0]['id']);
            return $soli;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getById($id){
        $query = "SELECT * FROM SolicitudCambio WHERE idSolicitudCambio = :idSolicitud";

        try{
            $connection = Connection::getInstance();
            $result = $connection->Execute($query, array(
                "idSolicitud" => $id
            ));
            return $result[0];
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    private function fetch($row){
        if($row == null)
            return null;
        return array(
            "idSolicitudCambio" => $row["idSolicitudCambio"],
            "idUsuario" => $row["idUsuario"],
            "fecha" => $row["fecha"],
            "estado" => $row["estado"]
        );
    }

    public function cambiarEstado($idSolicitud){
        $query = "UPDATE SolicitudCambio SET estado = 1 WHERE idSolicitudCambio = :idSolicitud";

        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "idSolicitud" => $idSolicitud
            ));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}