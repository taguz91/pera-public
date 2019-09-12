<?php
require_once 'src/modelo/reporte/ficha.php';
require_once  'vendor/autoload.php';

class Ficha {

  static function FS($idPersona, $idPersonaFicha){
    $res = ReporteFicha::getReporteFS($idPersona, $idPersonaFicha);
    $res  = json_decode($res['alumnos'], true);
    require_once 'src/reporte/ficha/socioeconomica.php';
    reporteFS($res[0], $idPersonaFicha);
  }

  static function FO($idPersonaFicha){

  }

}

function reportHead($var){
  $footer='
  <p align="right">
  <strong>'.$var.' </strong> | '.
    strftime("%d-%m-%Y")
  .'</p>';
  return $footer;
}

 ?>
