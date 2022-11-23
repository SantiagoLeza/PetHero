<?php 

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once '../Code/PHPMailer/Exception.php';
include_once '../Code/PHPMailer/PHPMailer.php';
include_once '../Code/PHPMailer/SMTP.php';

class MailController{
    
    public function sendMail($to, $subject, $message, $baseMesagge) {
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'pet.hero2002@gmail.com';                     // SMTP username
            $mail->Password = 'bpgyyjoeicymwdul';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;
            
            //Recipients
            $mail->setFrom('pet.hero2002@gmail.com', 'Pet Hero');
            $mail->addAddress($to);     // Add a recipient
    
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $baseMesagge;
    
            $mail->CharSet = 'UTF-8';
    
            $mail->send();
        } catch (Exception $e) {
            header('Location: '.FRONT_ROOT.'Home/Home/Error');
        }
    }

    public function SendCupon($to, $date, $razonSocial, $monto, $fechaInicio, $fechaFin, $nombreMascota){
        $body = "
        <html>
            <head>
                <title>Comprobante de compra</title>
            </head>
            <body style='background-color: #FCAA55; color:white;'>
                <h1 style='text-aline:center;'>Comprobante de compra</h1>
                <p>Fecha: $date</p>
                <p>Razon social: $razonSocial</p>
                <p>Monto: $monto</p>
                <p>Fecha de inicio: $fechaInicio</p>
                <p>Fecha de fin: $fechaFin</p>
                <p>Nombre de la mascota: $nombreMascota</p>
            </body>
        
        ";
        $planeMessage = "
        Comprobante de compra\n
        Fecha: $date\n
        Razon social: $razonSocial\n
        Monto: $monto\n
        Fecha de inicio: $fechaInicio\n
        Fecha de fin: $fechaFin\n
        Nombre de la mascota: $nombreMascota\n
        ";
        
        $this->sendMail(
            $to,
            'Comprobante de pago',
            $body,
            $planeMessage
        );
    }

}

?>