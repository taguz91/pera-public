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

    $existe = SincronizarBD::existeAsistencia(
      $asi['id_curso'],
      $asi['fecha']
    );
    $existe = isset($existe['existe']);
    $sql = '';
    if (!$existe) {
        $sql = self::$INSERTB;
    }

    if (isset($asi['alumnos'])) {
      foreach ($asi['alumnos'] as $alu) {
        if ($existe) {
          $sql .= self::getUpdate($alu);
        } else {
          $sql .= self::getInsert($alu);
        }
      }
      $sql = substr($sql, 0, -1) . ';';
      $res = executeScript($sql, []);
      JSON::resSQL($res, 'Sincronizamos correctamente: ');
    } else {
      JSON::error('No tenemos alumnos para editar.');
    }
  }

  static function getInsert($alu) {
    return "
    (".$alu['id_almn_curso'].", "."TO_DATE('".$alu['fecha']."', 'DD/MM/YYYY')".", ".$alu['horas']."),";
  }

  static function getUpdate($alu) {
    return '
    UPDATE public."Asistencia"
    SET numero_faltas = '.$alu['horas'].'
    WHERE id_almn_curso = '.$alu['id_almn_curso']."
    AND "."to_char(fecha_asistencia,'DD/MM/YYYY')"." = '".$alu['fecha']."';";
  }

  static $INSERTB = '
  INSERT INTO public."Asistencia"(
  id_almn_curso,
  fecha_asistencia,
  numero_faltas )
  VALUES ';

}
