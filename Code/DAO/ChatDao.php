<?php

namespace DAO;

class ChatDao
{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance();
    }

    public function add($texto, $idUsuario, $idGuardian, $fromUser){
        $sql = "call nuevo_mensaje(:texto, :idUsuario, :idGuardian, :fromUser?)";
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, array(
                "texto" => $texto,
                "idUsuario" => $idUsuario,
                "idGuardian" => $idGuardian,
                "fromUser" => $fromUser
            ));
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetChatsByUser($userId){
        $sql = "select Chat.idChat, CONCAT (U1.nombre, ' ', U1.apellido) as 'NombreDuenio', CONCAT (U2.nombre, ' ', U2.apellido) as 'NombreGuardian'
                from Chat
                join Usuarios as U1
                on Chat.idDuenio = U1.idUsuario
                join Usuarios as U2
                on Chat.idGuardian = U2.idUsuario
                join Mensaje
                on Mensaje.idChat = Chat.idChat
                where Chat.idDuenio = :userId or
                Chat.idGuardian = :userId
                ;";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql, array("userId" => $userId));
            $chats = array();
            foreach($result as $row){
                array_push($chats, $this->fetch($row));
            }
            return $chats;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    private function fetch($row){
        $chat = array(
            "chatId" => $row["idChat"],
            "nombreDuenio" => ($row["NombreDuenio"]),
            "nombreGuardian" => ($row["NombreGuardian"])
        );
        return $chat;
    }

    public function GetMensajesByChatId($idChat){
        $sql = "select *
                from Mensaje
                where idChat = :idChat
                ;";
        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql, array("idChat" => $idChat));
            $mensajes = array();
            foreach($result as $row){
                array_push($mensajes, $this->fetchMensajes($row));
            }
            return $mensajes;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function sendMensaje($texto, $idChat){
        $sql = "insert into Mensaje (idRemitente, texto, idChat)
                values (:idRemitente, :texto, :idChat)
                ;";
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, array(
                "idRemitente" => $_SESSION["loggedUser"]->getId(),
                "texto" => $texto,
                "idChat" => $idChat
            ));
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function fetchMensajes($row){
        $mensaje = array(
            "mensajeId" => $row["idMensaje"],
            "idRemitente" => $row["idRemitente"],
            "texto" => $row["texto"],
            "idChat" => $row["idChat"]
        );
        return $mensaje;
    }

}


?>