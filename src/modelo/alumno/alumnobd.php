<?php

class AlumnoBD {

  static private $BASEQUERY = '
  SELECT
  a.id_alumno,
  p.id_persona,
  persona_primer_nombre,
  persona_primer_apellido,
  persona_segundo_nombre,
  persona_segundo_apellido,
  persona_identificacion,
  persona_correo,
  persona_celular,
  persona_telefono
  FROM
  public."Alumnos" a, public."Personas" p
  WHERE
  p.id_persona = a.id_persona ';

  static private $ENDQUERY = '
  AND persona_activa = true
  AND alumno_activo = true
  ORDER BY
  persona_primer_apellido,
  persona_segundo_apellido;';

  static function cargarTodos() {
    $query = self::$BASEQUERY . ' ' . self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  static function buscar($id_alumno){
    $query = self::$BASEQUERY . "
    AND a.id_alumno = :idAlumno
    " . self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idAlumno' => $id_alumno
    ]);
  }

  static function buscarAlumno($aguja){
    $query = self::$BASEQUERY . '
    AND ('.buscarPersona($aguja).')
    ' . self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  static function buscarPorCurso($id_curso) {
    $query = self::$BASEQUERY . '
    AND id_alumno IN (
      SELECT id_alumno
      FROM public."AlumnoCurso"
      WHERE id_curso = :idCurso
      AND almn_curso_activo = true
    )' . self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idCurso' => $id_curso
    ]);
  }

  // Para actualizar la informacion de un alumno
  static function actualizarDato($idAlumno, $valor, $columna){
    $sql = '
    UPDATE public."Alumnos"
    SET '.$columna.' = :valor
    WHERE id_alumno = :id;';
    return executeSQL($sql, [
      'valor' => $valor,
      'id' => $idAlumno
    ]);
  }

  // Informacion de alumno
  static function getPorId($idPersona){
    $sql = '
    SELECT
    id_alumno,
    alumno_tipo_colegio,
    alumno_tipo_bachillerato,
    alumno_anio_graduacion,
    alumno_educacion_superior,
    alumno_titulo_superior,
    alumno_nivel_academico,
    alumno_pension,
    alumno_ocupacion,
    alumno_trabaja,
    alumno_nivel_formacion_padre,
    alumno_nivel_formacion_madre,
    alumno_nombre_contacto_emergencia,
    alumno_parentesco_contacto,
    alumno_numero_contacto,
    alumno_email_cotacto_emergencia,
    alumno_clase_social
    FROM public."Alumnos"
    WHERE alumno_activo = true AND
    id_persona = :id;';
    return getOneFromSQL($sql, [
      'id' => $idPersona
    ]);
  }

}

?>
