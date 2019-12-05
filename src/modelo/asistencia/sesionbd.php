<?php

class SesionBD {

  static function getDiasByCurso($idCurso) {
    $sql = '
    SELECT prd_lectivo_fecha_inicio,
    prd_lectivo_fecha_fin, (
      SELECT MIN(dia_sesion)
      FROM public."SesionClase"
      WHERE id_curso = cr.id_curso
    ) dia_inicia, (
      SELECT  MAX(dia_sesion)
      FROM public."SesionClase"
      WHERE id_curso = cr.id_curso
    )AS dia_fin, (
      SELECT array_to_json(
        array_agg(d.*)
      ) AS horas FROM (
        SELECT
        dia_sesion,
        COUNT(dia_sesion) AS num_horas
        FROM public."SesionClase"
        WHERE id_curso = cr.id_curso
        GROUP BY dia_sesion
      ) AS d
    ) AS dias

    FROM public."PeriodoLectivo" plr
    JOIN public."Cursos" cr
    ON cr.id_prd_lectivo = plr.id_prd_lectivo
    WHERE id_curso = :idCurso ';
    return getOneFromSQL($sql, [
      'idCurso' => $idCurso
    ]);
  }

}
