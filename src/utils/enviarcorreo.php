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
      $mail->Username = 'ubi.ista.2019@gmail.com';
      $mail->Password = 'ubISTA2019*';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom('ubi.ista.2019@gmail.com', 'ISTA - Desarrollo de Software');
      $mail->addAddress($correo);
      $mail->isHTML(true);
      $mail->Subject = 'Ficha | UBI - ISTA';
      $mail->Body =
      '<p>'. $mensaje.'</p>'.
      '<p> A continuación se presenta un enlace el cual le redirecciona a la página de ingreso de su ficha</p>
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
      return $e;
    }
  }

  static function enviarConCorreo($correousar, $passwordusar, $correoenviar, $asunto, $mensaje){
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $correousar;
      $mail->Password = $passwordusar;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom($correousar, 'ISTA - Desarrollo de Software');
      $mail->addAddress($correoenviar);
      $mail->isHTML(false);
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;
      $mail->send();
      return true;
    } catch (Exception $e) {
      return $e;
    }
  }

  static function enviarConConArchivo(
    $correousar,
    $passwordusar,
    $correoenviar,
    $asunto,
    $mensaje,
    $adjunto
  ){
    $mail = new PHPMailer(true);
    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $correousar;
      $mail->Password = $passwordusar;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom($correousar, 'ISTA - Desarrollo de Software');
      $mail->addAddress($correoenviar);
      $mail->isHTML(false);
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;
      $mail->AddAttachment($adjunto['tmp_name'], $adjunto['name']);
      $mail->send();
      return true;
    } catch (Exception $e) {
      return $e;
    }
  }

}
