<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class EnviarCorreo {

  static function enviar($correo, $pass, $mensaje){
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = '15andresc@gmail.com';
      $mail->Password = 'Pai@123*';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom('15andresc@gmail.com', 'ISTA - Desarrollo de Software');
      $mail->addAddress($correo);
      $mail->isHTML(true);
      $mail->Subject = 'Ficha Socioecon&oacute;mica';
      $mail->Body =
      '<p>'. $mensaje.'</p>'.
      '<p> A continuación se presenta un enlace el cual le redirecciona a la página de ingreso de la ficha</p>
      <hr>
      <h2>Su contraseña es: </h2> <h1>'.$pass.'</h1>
      <hr>
      <p>
        <a href="http://ubi.tecazuay.edu.ec" target="_blank">Click </a>
        para ingresar su ficha
      </p>
      <hr>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}
