<?php

class AsistenciaSV {

  static function iniciarAsistencia($idCurso, $fecha) {
    $res = AsistenciaBD::getAsistencia($idCurso, $fecha);
    if (count($res) == 0) {
      $res = AsistenciaBD::iniciarAsistencia($idCurso, $fecha);
      if (is_bool($res)) {
        $res = AsistenciaBD::getAsistencia($idCurso, $fecha);
      }
    }
    return $res;
  }

}
