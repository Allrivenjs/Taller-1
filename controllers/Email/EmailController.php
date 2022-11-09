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

  public function sendEmail($userMail, $userName, $valueSent = "0", $accountType = "ahorro", $typeTransfer = "externa", $isReceiving = true, $isFaild = false, $message, $table)
  {
    try {

      $email = getenv('EMAIL_CREDENTIAL');
      $password = getenv('PASSWORD_CREDENTIAL');
      // PHPMailer instance
      $mail = new PHPMailer();

      // It is required to be able to use an SMTP server such as gmail
      $mail->isSMTP();

      //Set the hostname of the mail server
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;

      // Property to set encryption security for communication
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

      // To enable server SMTP authentication
      $mail->SMTPAuth = true;

      // Account credentials
      $mail->Username = $email;
      $mail->Password = $password;

      // Who sends this message
      $mail->setFrom($email, 'BANCA RAPIDA');

      // Addressee
      $mail->addAddress($userMail, 'Hola ', $userName);

      // Subject of the email
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

      // Content
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';
      $mail->MsgHTML($message);

      // Alt text
      $mail->AltBody = 'BANCA RAPIDA LE INFORMA';

      // Send the mail
      if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
      }

      return 'Mail sent';
    } catch (Exception $e) {
      throw new Exception($e);
    }
  }
}
