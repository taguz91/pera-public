<?php

class AsistenciaBD {

  static function iniciarAsistencia($idCurso, $fecha) {
    $sql = '
    INSERT INTO public."Asistencia"(
    id_almn_curso,
    fecha_asistencia,
    numero_faltas )
    SELECT id_almn_curso,
    :fecha,
    0
    FROM public."AlumnoCurso"
    WHERE id_curso = :idCurso;';
    return executeSQL($sql, [
      'fecha' => $fecha,
      'idCurso' => $idCurso
    ]);
  }

  static function getAsistencia($idCurso, $fecha) {
    $sql = "
    SELECT
    id_asistencia,
    persona_primer_apellido || ' ' ||
    persona_segundo_apellido || ' ' ||
    persona_primer_nombre || ' ' ||
    persona_segundo_nombre AS alumno,
    numero_faltas
    " . '
    FROM public."Asistencia" aa
    JOIN public."AlumnoCurso" ac
    ON ac.id_almn_curso = aa.id_almn_curso
    JOIN public."Alumnos" a
    ON ac.id_alumno = a.id_alumno
    JOIN public."Personas" p
    ON p.id_persona = a.id_persona
    WHERE ac.id_curso = :idCurso
    AND fecha_asistencia = :fecha
    ORDER BY persona_primer_apellido,
    persona_segundo_apellido,
    persona_primer_nombre,
    persona_segundo_nombre;';
    return getArrayFromSQL($sql, [
      'idCurso' => $idCurso,
      'fecha' => $fecha
    ]);
  }

  static function actualizar($idAsistencia, $numFalta) {
    $sql = '
    UPDATE public."Asistencia"
    SET numero_faltas = :numFalta
    WHERE id_asistencia = :idAsistencia;';
    return executeSQL($sql, [
      'numFalta' => $numFalta,
      'idAsistencia' => $idAsistencia
    ]);
  }

  static function getUltimosCursosByDocente($identificacion) {
    $sql = '
    SELECT
    c.id_curso,
    prd_lectivo_nombre,
    materia_nombre,
    curso_nombre,
    dia_sesion
    FROM public."SesionClase" sc
    JOIN public."Cursos" c
    ON sc.id_curso = c.id_curso
    JOIN public."Materias" m
    ON m.id_materia = c.id_materia
    JOIN public."Docentes" d
    ON d.id_docente = c.id_docente
    JOIN public."Personas" p
    ON p.id_persona = d.id_persona
    JOIN public."PeriodoLectivo" pl
    ON pl.id_prd_lectivo = c.id_prd_lectivo
    WHERE persona_identificacion = :identificacion
    AND prd_lectivo_estado = true
    GROUP BY
    c.id_curso,
    prd_lectivo_nombre,
    materia_nombre,
    curso_nombre,
    dia_sesion,
    prd_lectivo_fecha_fin
    ORDER BY prd_lectivo_fecha_fin DESC,
    dia_sesion,
    materia_nombre;';
    return getArrayFromSQL($sql, [
      'identificacion' => $identificacion
    ]);
  }

  static function getAlumnosNuevosDocente($identificacion = ''){
    $sql = "
    SELECT
    c.id_curso,
    id_almn_curso,
    pa.persona_primer_apellido || ' ' ||
    pa.persona_segundo_apellido || ' ' ||
    pa.persona_primer_nombre || ' ' ||
    pa.persona_segundo_nombre as alumno
    " . '
    FROM public."Cursos" c
    JOIN public."PeriodoLectivo" pl
    ON pl.id_prd_lectivo = c.id_prd_lectivo
    JOIN public."Docentes" d
    ON d.id_docente = c.id_docente
    JOIN public."Personas" pd
    ON pd.id_persona = d.id_persona
    JOIN public."AlumnoCurso" ac
    ON ac.id_curso = c.id_curso
    JOIN public."Alumnos" a
    ON ac.id_alumno = a.id_alumno
    JOIN public."Personas" pa
    ON pa.id_persona = a.id_persona
    WHERE pd.persona_identificacion = :identificacion
    ORDER BY c.id_curso;';
    return getArrayFromSQL($sql, [
      'identificacion' => $identificacion
    ]);
  }

}
