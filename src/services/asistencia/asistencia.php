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

  static function sincronizar($asi) {
    require_once 'src/modelo/asistencia/sincronizarbd.php';
/*
    $existe = SincronizarBD::existeAsistencia(
      $asi['id_curso'],
      $asi['fecha']
    );*/
    $existe = isset($existe['existe']);
    $sql = '';
    if (!$existe) {
        $sql = self::$INSERTB;
    }
    var_dump($asi);
    $alumnos = $asi['alumnos'];
    if (isset($alumnos)) {
      foreach ($alumnos as $alu) {
        if ($existe) {
          $sql .= self::getUpdate($alu);
        } else {
          $sql .= self::getInsert($alu);
        }
      }
      echo "<hr>";
      $sql = substr($sql, 0, -1) . ';';
      var_dump($sql);
      echo "<br>";
    }
  }

  static function getInsert($alu) {
    return "
    (".$alu['id_almn_curso'].", '".$alu['fecha']."', ".$alu['horas']."),";
  }

  static function getUpdate($alu) {
    return '
    UPDATE public."Asistencia"
    SET numero_faltas = '.$alu['horas'].'
    WHERE id_almn_curso = '.$alu['id_almn_curso'].'
    AND fecha_asistencia = \''.$alu['fecha'].'\';';
  }

  static $INSERTB = '
  INSERT INTO public."Asistencia"(
  id_almn_curso,
  fecha_asistencia,
  numero_faltas )
  VALUES ';

}
