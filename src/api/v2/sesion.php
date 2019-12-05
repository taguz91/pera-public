<?php
require_once 'src/modelo/asistencia/sesionbd.php';

class SesionAPI {

  function fechas($idCurso = 0) {
    if ($idCurso != 0) {
      require_once 'src/services/asistencia/fechas.php';
      $res = FechasClaseSV::getFechasClaseCurso($idCurso);
      JSON::muestraJSON($res);
    } else {
      JSON::error('No tenemos el id_curso para buscarlo.');
    }
  }

}
