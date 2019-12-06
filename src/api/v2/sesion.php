<?php
require_once 'src/modelo/asistencia/sesionbd.php';
require_once 'src/services/asistencia/fechas.php';

class SesionAPI {

  function fechas() {
    $identificacion = isset($_GET['identificacion']) ? $_GET['identificacion'] : null;
    $idCurso = isset($_GET['idCurso']) ? $_GET['idCurso'] : 0;

    if ($idCurso != 0) {
      $res = FechasClaseSV::getSoloFechasClaseCurso($idCurso);
      JSON::muestraJSON($res);
    }

    if ($identificacion != null) {
      $res = FechasClaseSV::getSoloFechasClaseIdentificacion($identificacion);
      JSON::muestraJSON($res);
    }

    if ($idCurso != 0 && $identificacion != null) {
      JSON::error('No tenemos el identificacion para buscarlo.');
    }
  }

  function info($idCurso = 0) {
    if ($idCurso != 0) {
      $res = FechasClaseSV::getFechasClaseCurso($idCurso);
      JSON::muestraJSON($res);
    } else {
      JSON::error('No tenemos el id_curso para buscarlo.');
    }
  }


}
