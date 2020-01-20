<?php

class SincronizarBD {

  static function existeAsistencia($idCurso, $fecha) {
    $sql = '
    SELECT 1 AS existe
    FROM public."Asistencia"
    WHERE id_almn_curso IN (
      SELECT id_almn_curso
      FROM public."AlumnoCurso"
      WHERE id_curso = :idCurso
    ) AND  fecha_asistencia = ' .
    "TO_DATE(:fecha, 'DD/MM/YYYY')" . ';';
    return getOneFromSQL($sql, [
      'idCurso' => $idCurso,
      'fecha' => $fecha
    ]);
  }

  static function actualizar($sql) {
    return executeSQL($sql, []);
  }

}
