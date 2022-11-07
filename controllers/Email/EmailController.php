<?php

namespace Controllers\Email;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class SendEmailController
{
  /**
   * @param $userMail
   * @param $userName
   * @param $valueSent
   * @param $accountType
   * @param $typeTransfer
   * @param $isReceiving
   * @param $isFaild
   * @return string
   */
  public function sendEmail($userMail, $userName, $valueSent = "0", $accountType = "ahorro", $typeTransfer = "externa", $isReceiving = true, $isFaild = false)
  {
    try {

      $message = file_get_contents("mail_templates/sample_mail.html");
      $table = file_get_contents("mail_templates/table.html");

      echo $message;

      // Intancia de PHPMailer
      $mail = new PHPMailer();

      // Es necesario para poder usar un servidor SMTP como gmail
      $mail->isSMTP();

      //Set the hostname of the mail server
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;

      // Propiedad para establecer la seguridad de encripción de la comunicación
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

      // Para activar la autenticación smtp del servidor
      $mail->SMTPAuth = true;

      // Credenciales de la cuenta
      $email = 'bancarapidanoreply@gmail.com';
      $mail->Username = $email;
      $mail->Password = 'twsmkayxanqoxnks';

      // Quien envía este mensaje
      $mail->setFrom($email, 'BANCA RAPIDA');

      // Destinatario
      $mail->addAddress($userMail, 'Hola ', $userName);

      // Asunto del correo
      $mail->Subject = 'BancaRapida le informa';


      $receiving = $isReceiving ? "Dinero enviado" : "Dinero recibido";
      $faild = $isFaild ? "rechazada" : "exitosa";
      $faildTitle = $isFaild ? "Transaccion rechazada" : "Transaccion exitosa";


      $table = str_replace('%receiving%', $receiving, $table);
      $table = str_replace('%valueSent%', $valueSent, $table);
      $table = str_replace('%date%', date('d F Y, h:i:s A'), $table);

      $faildTable = $isFaild ? "rechazada" : $table;

      $message = str_replace('%userName%', $userName, $message);
      $message = str_replace('%faildTitle%', $faildTitle, $message);
      $message = str_replace('%accountType%', $accountType, $message);
      $message = str_replace('%faild%', $faild, $message);
      $message = str_replace('%typeTransfer%', $typeTransfer, $message);
      $message = str_replace('%faildTable%', $faildTable, $message);

      // Contenido
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';
      $mail->MsgHTML($message);

      // Texto alternativo
      $mail->AltBody = 'BANCA RAPIDA LE INFORMA';

      // Enviar el correo
      if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
      }

      return 'Correo enviado';
    } catch (Exception $e) {
      throw new Exception($e);
    }
  }
}
?>