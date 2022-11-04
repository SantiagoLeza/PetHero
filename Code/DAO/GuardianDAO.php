<?php

namespace DAO;

use Models\Guardian as Guardian;

class GuardianDAO{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::GetInstance();
    }

    public function Add($idUsuario, $fechaInicio, $fechaFin, $tamanio, $direccionCuidado, $descripcion){
        $query = "INSERT INTO Guardianes (idUsuario, valoracion, fechaInicio, fechaFin, saldoAcumulado, tamanioAceptado, direccionCuidado, descripcion) VALUES (:idUsuario, 0, :fechaInicio, :fechaFin, 0, :tamanio, :direccionCuidado, :descripcion);";
        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "idUsuario" => $idUsuario,
                "fechaInicio" => $fechaInicio,
                "fechaFin" => $fechaFin,
                "tamanio" => $tamanio,
                "direccionCuidado" => $direccionCuidado,
                "descripcion" => $descripcion
            ));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getAll(){
        try{
            $guardianList = array();
            $query = "SELECT * FROM Guardianes";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            foreach($resultSet as $row){
                $guardian = new Guardian(
                    $row["idGuardian"],
                    $row["idUsuario"],
                    $row["valoracion"],
                    $row["fechaInicio"],
                    $row["fechaFin"],
                    $row["saldoAcumulado"],
                    $row["tamanioAceptado"],
                    $row["direccionCuidado"],
                    $row["descripcion"]
                );
                array_push($guardianList, $guardian);
            }
            return $guardianList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByMail($mail){
        try{
            $query = "SELECT * FROM Usuarios as u join Guardianes as g on u.idUsuario = g.idUsuario WHERE u.mail = :mail";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("mail" => $mail));
            foreach($resultSet as $row){
                $guardian = new Guardian(
                    $row["idGuardian"],
                    $row["idUsuario"],
                    $row["valoracion"],
                    $row["fechaInicio"],
                    $row["fechaFin"],
                    $row["saldoAcumulado"],
                    $row["tamanioAceptado"],
                    $row["direccionCuidado"],
                    $row["descripcion"]
                );
            }
            return $guardian;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getById($id){
        try{
            $query = "SELECT * FROM Guardianes WHERE idGuardian = :id";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("id" => $id));
            foreach($resultSet as $row){
                $guardian = new Guardian(
                    $row["idGuardian"],
                    $row["idUsuario"],
                    $row["valoracion"],
                    $row["fechaInicio"],
                    $row["fechaFin"],
                    $row["saldoAcumulado"],
                    $row["tamanioAceptado"],
                    $row["direccionCuidado"],
                    $row["descripcion"]
                );
            }
            return $guardian;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByDates($inicio, $fin){
        try{
            $guardianList = array();
            $query = "SELECT * FROM Usuarios as u join Guardianes as g on u.idUsuario = g.idUsuario WHERE g.fechaInicio >= :inicio AND g.fechaFin <= :fin";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("inicio" => $inicio, "fin" => $fin));
            foreach($resultSet as $row){
                $guardian = new Guardian(
                    $row["idUsuario"],
                    $row["nombre"],
                    $row["apellido"],
                    $row["mail"],
                    $row["clave"],
                    $row["fechaNacimiento"],
                    $row["dni"],
                    $row["telefono"],
                    $row["valoracion"],
                    $row["fechaInicio"],
                    $row["fechaFin"],
                    $row["saldoAcumulado"],
                    $row["tamanioAceptado"],
                    $row["direccionCuidado"],
                    $row["descripcion"]
                );
                array_push($guardianList, $guardian);
            }
            return $guardianList;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function isGuardian($idUsuario){
        try{
            $query = "SELECT * FROM Guardianes WHERE idUsuario = :idUsuario";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, array("idUsuario" => $idUsuario));
            if($resultSet != null){
                return true;
            }
            else{
                return false;
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
?>