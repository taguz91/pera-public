<?php
require_once 'src/modelo/reporte/ficha.php';
require_once  'vendor/autoload.php';

class Ficha {

  static function FS($idPersona, $idPersonaFicha){
    $res = ReporteFicha::getReporteFS($idPersona, $idPersonaFicha);
    $res  = json_decode($res['alumnos'], true);
    require_once 'src/reporte/ficha/socioeconomica.php';
    reporteFS($res[0]);
  }

  static function FO($idPersonaFicha){

  }

}

function reportHead($var){
  $footer='
  <p align="right">'.$var.' | '.
    strftime("%d-%m-%Y")
  .'</p>';
  return $footer;
}

 ?>
