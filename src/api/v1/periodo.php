<?php
require_once 'src/modelo/periodo/periodobd.php';

class PeriodoAPI {

  function ciclos($idPermiso = 0) {
    if ($idPermiso != 0) {
      $items = PeriodoBD::getCiclosByPermiso($idPermiso);
      JSON::muestraJSON($items);
    } else {
      $idPeriodo = isset($_GET['idPeriodo']) ? $_GET['idPeriodo'] : 0;
      if ($idPeriodo != 0) {
        $items = PeriodoBD::getCiclosByPeriodo($idPeriodo);
        JSON::muestraJSON($items);
      } else {
        JSON::error('Debe especificarnos el id del periodo.');
      }
    }
  }

  function cmbGuardar($idTipoFicha = 0) {
    if ($idTipoFicha != 0) {
      $items = PeriodoBD::getParaCmbGuardar($idTipoFicha);
      JSON::muestraJSON($items);
    } else {
      JSON::error('Debe especificarnos el id del tipo de ficha.');
    }
  }

  function noMatriculados($idPeriodo = 0) {
    if($idPeriodo != 0){
      require 'src/modelo/persona/correosbd.php';
      $items = CorreosBD::getCorreosAlumnosNoMatriculadosPeriodo($idPeriodo);
      JSON::muestraJSON($items);
    } else {
      JSON::error('No indico los parametros requeridos. periodo-ciclo');
    }
  }

}
