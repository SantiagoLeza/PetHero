<?php

namespace DAO;

use Models\Reserva as Reserva;

class ReservaDAO
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function Add($idGuardian, $idAnimal, $fechaInicio, $fechaFin, $precio, $estado)
    {
       $query = "INSERT INTO Reservas (idGuardian, idAnimal, fechaInicio, fechaFin, precio, estado, pago) VALUES (:idGuardian, :idAnimal, :fechaInicio, :fechaFin, :precio, :estado, 0);";

        try
        {
            $this->connection = Connection::getInstance();

            $this->connection->ExecuteNonQuery($query, array(
                "idGuardian" => $idGuardian,
                "idAnimal" => $idAnimal,
                "fechaInicio" => $fechaInicio,
                "fechaFin" => $fechaFin,
                "precio" => $precio,
                "estado" => $estado
            ));
            
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAll()
    {
        $query = "SELECT * FROM Reservas";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query);
            $reservas = array();

            foreach($result as $row)
            { 
                array_push($reservas, $this->fetch($row));
                
            }

            return $reservas;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getByIdGuardian($idGuardian)
    {
        $query = "SELECT * FROM Reservas WHERE idGuardian = :idGuardian";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idGuardian" => $idGuardian));
            $reservas = array();
            if(count($result) == 0)
            {
                return null;
            }

            foreach($result as $row)
            {
                array_push($reservas, $this->fetch($row));
            }

            return $reservas;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getByIdAnimal($idAnimal)
    {
        $query = "SELECT * FROM Reservas WHERE idAnimal = :idAnimal";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idAnimal" => $idAnimal));
            $reservas = array();
            if(count($result) == 0)
            {
                return null;
            }

            foreach($result as $row)
            {
                array_push($reservas, $this->fetch($row));
            }

            return $reservas;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function searchReserva($idGuardian,$fechainicio, $fechafin)
    {
        $query = "SELECT * FROM Reservas WHERE idGuardian = :idGuardian AND (fechaInicio >= :fechainicio && fechaFin <= :fechafin)";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idGuardian" => $idGuardian, "fechainicio" => $fechainicio, "fechafin" => $fechafin));
            $reservas = array();
            if(count($result) == 0)
            {
                return null;
            }

            foreach($result as $row)
            {
                array_push($reservas, $this->fetch($row));
            }

            return $reservas;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function AceptarReserva($idReserva)
    {
        $query = "UPDATE Reservas SET estado = 'Aceptado' WHERE idReserva = :idR";
        
        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, array("idR" => $idReserva));
            $query2 = 
            "update Reservas as r
            set r.estado = 'Cancelado'
            where r.idReserva in (
                select sq.idReserva
                from (
                    select idReserva
                    from Reservas as r2
                    join Animales as a
                    on r2.idAnimal = a.idAnimales
                    where r2.estado = 'Pendiente' and
                    r2.idGuardian = (SELECT r4.idGuardian from Reservas as r4 WHERE r4.idReserva = :idR)
                    and a.idTipoAnimal <> (
                        SELECT idTipoAnimal
                        FROM Animales as a2
                        JOIN Reservas as r3
                        ON a2.idAnimales = r3.idAnimal
                        WHERE idReserva = :idR
                    )
                    and r2.fechaInicio <= (SELECT r5.fechaFin from Reservas as r5 WHERE r5.idReserva = :idR)
                    and r2.fechaFin >= (SELECT r6.fechaInicio from Reservas as r6 WHERE r6.idReserva = :idR)
                ) as sq
            );";
            $this->connection->ExecuteNonQuery($query2, array("idR" => $idReserva));
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function RechazarReserva($idReserva)
    {
        $query = "UPDATE Reservas SET estado = 'Cancelado' WHERE idReserva = :idReserva";

        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, array("idReserva" => $idReserva));
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function CancelarReserva($idReserva)
    {
        $query = "UPDATE Reservas SET estado = 'Cancelado' WHERE idReserva = :idReserva";

        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, array("idReserva" => $idReserva));
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function checkReservas(){
        $query1 = "UPDATE Reservas SET estado = 'En curso' WHERE estado = 'Aceptado' && fechaInicio <= CURDATE()";

        $query2 = "UPDATE Reservas SET estado = 'Finalizado' WHERE estado = 'En curso' && fechaFin <= CURDATE()";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query1);
            $result = $this->connection->Execute($query2);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getById($idReserva)
    {
        $query = "SELECT * FROM Reservas WHERE idReserva = :idReserva";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idReserva" => $idReserva));

            $reserva = $this->fetch($result[0]);

            return $reserva;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAllByUser($idUsuario){
        $query = "
            SELECT * FROM Reservas as r
            JOIN Animales as a
            ON r.idAnimal = a.idAnimales
            WHERE a.idDuenio = :idUsuario
        ";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idUsuario" => $idUsuario));
            $reservas = array();
            if(count($result) == 0)
            {
                return null;
            }

            foreach($result as $row)
            {
                array_push($reservas, $this->fetch($row));
            }

            return $reservas;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function PagarReserva($idReserva, $numeroTarjeta, $fechaVencimiento, $nombreTitular, $cvv, $monto)
    {
        $query = "UPDATE Reservas SET pago = 1 WHERE idReserva = :idReserva; ";

        try
        {
            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, array("idReserva" => $idReserva));
            
            $query2 = "CALL cargarPago(:nTarjeta, :fechaV, :nombre, :cvv, :monto, :idReserva);";
            $this->connection->ExecuteNonQuery($query2, array(
                "nTarjeta" => $numeroTarjeta,
                "fechaV" => $fechaVencimiento,
                "nombre" => $nombreTitular,
                "cvv" => $cvv,
                "monto" => $monto,
                "idReserva" => $idReserva
            ));
        }
        catch(Exception $ex)
        {
            
            throw $ex;
        }
    }

    public function getFacturaById($idReserva){
        $query = "SELECT * FROM Factura
        JOIN Pagos ON Factura.idPago = Pagos.idPagos
        WHERE Pagos.idReserva = :idReserva";

        try
        {
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($query, array("idReserva" => $idReserva));

            return array(
                "fecha" => $result[0]["fechaFactura"],
                "razonSocial" => $result[0]["razonSocial"],
            );
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        
    }


    private function fetch ($row)
    {
        if($row == null)
        {
            return null;
        }
        return new Reserva(
            $row["idReserva"],
            $row["idGuardian"],
            $row["idAnimal"],
            $row["fechaInicio"],
            $row["fechaFin"],
            $row["precio"],
            $row["estado"],
            $row["pago"]
        );

    }
}

?>