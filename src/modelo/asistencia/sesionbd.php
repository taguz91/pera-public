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


  static function getDiasByDocente($identificacion) {
    $sql = '
    SELECT cr.id_curso,
    prd_lectivo_fecha_inicio,
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
    WHERE id_curso IN (
      SELECT c.id_curso
      FROM public."Cursos" c
      JOIN public."Materias" m
      ON m.id_materia = c.id_materia
      JOIN public."Docentes" d
      ON d.id_docente = c.id_docente
      JOIN public."Personas" p
      ON p.id_persona = d.id_persona
      JOIN public."PeriodoLectivo" pl
      ON pl.id_prd_lectivo = c.id_prd_lectivo
      WHERE prd_lectivo_estado = true
      AND persona_identificacion = :identificacion
    ) ';
    return getArrayFromSQL($sql, [
      'identificacion' => $identificacion
    ]);
  }

}
