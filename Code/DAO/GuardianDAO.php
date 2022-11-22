<?php

namespace DAO;

use Models\Guardian as Guardian;

use DAO\ReservaDAO as ReservaDAO;
use DAO\AnimalDAO as AnimalDAO;

class GuardianDAO{
    private $connection;
    private $reservaDAO;
    private $animalDAO;
    
    public function __construct(){
        $this->connection = Connection::GetInstance();
        $this->reservaDAO = new ReservaDAO();
        $this->animalDAO = new AnimalDAO();
    }

    public function Add($idUsuario, $fechaInicio, $fechaFin, $tamanio, $direccionCuidado, $descripcion, $precio){
        $query = "INSERT INTO Guardianes (idUsuario, valoracion, fechaInicio, fechaFin, saldoAcumulado, tamanioAceptado, direccionCuidado, descripcion, precio) VALUES (:idUsuario, 0, :fechaInicio, :fechaFin, 0, :tamanio, :direccionCuidado, :descripcion, :precio);";
        try{
            $connection = Connection::getInstance();
            $connection->ExecuteNonQuery($query, array(
                "idUsuario" => $idUsuario,
                "fechaInicio" => $fechaInicio,
                "fechaFin" => $fechaFin,
                "tamanio" => $tamanio,
                "direccionCuidado" => $direccionCuidado,
                "descripcion" => $descripcion,
                "precio" => $precio
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
                array_push($guardianList, $this->fetch($row));
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
                $guardian = $this->fetch($row);
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
                $guardian = $this->fetch($row);
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
                array_push($guardianList, $this->fetch($row));
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

    public function GetEstadoGuardian($idGuardian, $fechaInicio, $fechaFin, $raza, $tamanio, $idAnimal){
        $guardian = $this->getById($idGuardian);
        if($guardian->getFechaFin() < $fechaFin || $guardian->getFechaInicio() > $fechaInicio){
            return "El cuidador no dispone de esas fechas";
        }
        if(!strstr($guardian->getTamanio(), $tamanio)){
            return "Tamaño no permitido por el cuidador";
        }
        $reservasPendiente = $this->reservaDAO->searchReserva($idGuardian, $fechaInicio, $fechaFin);
        if($reservasPendiente != null){
            foreach($reservasPendiente as $reserva){
                if($reserva->getIdAnimal() == $idAnimal && $reserva->getIdGuardian() == $idGuardian && $fechaInicio < $reserva->getFechaFin() && $fechaFin > $reserva->getFechaInicio()){
                    return "Ya existe una reserva pendiente para ese animal";
                }
                if($reserva->getEstado() == 'Pendiente' || $reserva->getEstado() == 'Cancelado' || $reserva->getEstado() == 'Finalizado'){
                    return 'OK';
                }
                if($reserva->getEstado() == 'Aceptado' || $reserva->getEstado() == 'En curso'){
                    if($this->animalDAO->getAnimalByID($reservasPendiente[0]->getIdAnimal())->getRaza() == $raza){
                        return "OK";
                    }
                    var_dump($reserva);
                    return "El cuidador ya tiene una reserva aceptada para esas fechas";
                }
            }
        }
        return "OK";
    }

    public function UpdateDates($idGuardian, $fechaInicio, $fechaFin){
        try{
            $query = "UPDATE Guardianes SET fechaInicio = :fechaInicio, fechaFin = :fechaFin WHERE idGuardian = :idGuardian";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, array("idGuardian" => $idGuardian, "fechaInicio" => $fechaInicio, "fechaFin" => $fechaFin));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function UpdatePrecio($idGuardian, $precio){
        try{
            $query = "UPDATE Guardianes SET precio = :precio WHERE idGuardian = :idGuardian";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, array("idGuardian" => $idGuardian, "precio" => $precio));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function UpdateSaldo($idGuardian, $saldo){
        try{
            $query = "UPDATE Guardianes SET saldoAcumulado = :saldo WHERE idGuardian = :idGuardian";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, array("idGuardian" => $idGuardian, "saldo" => $saldo));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function AddSaldo($idGuardian, $saldo){
        try{
            $query = "UPDATE Guardianes SET saldoAcumulado = saldoAcumulado + :saldo WHERE idGuardian = :idGuardian";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, array("idGuardian" => $idGuardian, "saldo" => $saldo));
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    private function fetch($row){
        if($row == null){
            return null;
        }
        return new Guardian(
            $row['idGuardian'],
            $row['idUsuario'],
            $row["valoracion"],
            $row["fechaInicio"],
            $row["fechaFin"],
            $row["saldoAcumulado"],
            $row["tamanioAceptado"],
            $row["direccionCuidado"],
            $row["descripcion"],
            $row["precio"]
        );
    }
}
?>