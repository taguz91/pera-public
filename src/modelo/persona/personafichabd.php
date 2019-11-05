<?php

abstract class PersonaFichaBD {

  static function getPorLogin($idPersona, $pass){
    $sql = '
    SELECT id_persona_ficha
    FROM public."PersonaFicha"
    WHERE id_persona = :idPer AND
    persona_ficha_clave = set_byte( MD5(:clave) :: bytea, 4, 64);';
    $res = getOneFromSQL($sql, [
      'idPer' => $idPersona,
      'clave' => $pass
    ]);
    if($res != null){
      return $res['id_persona_ficha'];
    }
  }

  static function finalizar($idPersonaFicha) {
    $sql = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_finalizada = true
    WHERE id_persona_ficha = :id;';
    return executeSQL($sql, [
      'id' => $idPersonaFicha
    ]);
  }

  static function actualizarFecha($idPersonaFicha) {
    $sql = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_fecha_ingreso = now()
    WHERE id_persona_ficha = :id;';
    return executeSQL($sql, [
      'id' => $idPersonaFicha
    ]);
  }

  static function getFinalizados() {
    $sql = self::$BASEQUERYTBL . ' ' . self::$ENDQUERYTBL;
    return getArrayFromSQL($sql , []);
  }

  static function getCorreosAlumnos($idPermiso, $numCiclo) {
    $sql = '
    SELECT id_persona,
    persona_primer_nombre || \' \' ||
    persona_primer_apellido AS persona_nombre,
    persona_correo
    FROM public."Personas"
    WHERE id_persona IN (
      SELECT id_persona FROM public."Alumnos"
      WHERE id_alumno IN (
          SELECT id_alumno FROM public."AlumnoCurso"
          WHERE id_curso IN (
            SELECT DISTINCT id_curso FROM public."Cursos"
            WHERE id_prd_lectivo = (
                SELECT id_prd_lectivo
                FROM public."PermisoIngresoFichas"
                WHERE id_permiso_ingreso_ficha = :idPermiso1
              )  AND curso_ciclo = :numCiclo
          )
      )
    ) AND id_persona NOT IN (
      SELECT id_persona FROM public."PersonaFicha"
      WHERE id_permiso_ingreso_ficha = :idPermiso2
    ) ORDER BY persona_primer_apellido;';
    return getArrayFromSQL($sql, [
      'idPermiso1' => $idPermiso,
      'numCiclo' => $numCiclo,
      'idPermiso2' => $idPermiso
    ]);
  }

  static function getCorreosDocentes($idPermiso, $numCiclo){
    $sql = '
    SELECT id_persona,
    persona_primer_nombre || \' \' ||
    persona_primer_apellido AS persona_nombre,
    persona_correo
    FROM public."Personas"
    WHERE id_persona IN (
      SELECT id_persona FROM public."Docentes"
      WHERE id_docente IN (
        SELECT DISTINCT id_docente FROM public."Cursos"
        WHERE id_prd_lectivo = (
          SELECT id_prd_lectivo FROM public."PermisoIngresoFichas"
          WHERE id_permiso_ingreso_ficha = :idPermiso1
          ) AND curso_ciclo = :numCiclo
        )
      ) AND id_persona NOT IN (
      SELECT id_persona FROM public."PersonaFicha"
      WHERE id_permiso_ingreso_ficha = :idPermiso2
    ) ORDER BY persona_primer_apellido;';

    return getArrayFromSQL($sql, [
      'idPermiso1' => $idPermiso,
      'numCiclo' => $numCiclo,
      'idPermiso2' => $idPermiso
    ]);
  }

  static function getIdTipo($idPermiso) {
    $sql = '
    SELECT id_tipo_ficha FROM public."PermisoIngresoFichas"
    WHERE id_permiso_ingreso_ficha = :idPermiso;';
    return getOneFromSQL($sql, [
      'idPermiso' => $idPermiso
    ]);
  }

  static $BASEQUERYTBL = '
  SELECT
  prd_lectivo_nombre,
  persona_primer_nombre,
  persona_primer_apellido,
  persona_identificacion,
  persona_correo,
  persona_ficha_fecha_ingreso,
  persona_ficha_fecha_modificacion
  FROM
  public."Personas" p
  JOIN public."PersonaFicha" pf ON
  p.id_persona = pf.id_persona
  JOIN public."PermisoIngresoFichas" pif ON
  pf.id_permiso_ingreso_ficha = pif.id_permiso_ingreso_ficha
  JOIN public."PeriodoLectivo" pl ON
  pl.id_prd_lectivo = pif.id_prd_lectivo
  WHERE persona_ficha_finalizada = true AND
  persona_ficha_activa = true ';

  static $ENDQUERYTBL = '
  ORDER BY
  persona_primer_apellido,
  persona_primer_nombre;';

}

 ?>
