<?php

class SilaboBD {

  static private $BASEQUERY = '
    SELECT
    s.id_silabo,
    prd_lectivo_nombre,
    materia_nombre,
    estado_silabo,
      STRING_AGG(
        curso_nombre, \', \'
      ) cursos
    FROM
    public."Silabo" s, public."Materias" m,
    public."PeriodoLectivo" pl, public."Cursos" c
    WHERE
    pl.id_prd_lectivo = s.id_prd_lectivo AND
    m.id_materia = s.id_materia AND
    c.id_materia = s.id_materia AND
    c.id_prd_lectivo = s.id_prd_lectivo AND
    estado_silabo = 1
  ';
  static private $ENDQUERY = '
    GROUP BY
    id_silabo,
    prd_lectivo_nombre,
    materia_nombre,
    estado_silabo
    ORDER BY prd_lectivo_nombre
  ';

  static function cargarSilabos(){
    $query =  self::$BASEQUERY .' '. self::$ENDQUERY;

    return getArrayFromSQL($query, []);
  }

  static function buscar($id_silabo){
    $query =  self::$BASEQUERY ."
    AND s.id_silabo = :idSilabo
    ". self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idSilabo' => $id_silabo
    ]);
  }

  static function buscarPorPeriodoMateria($aguja){
    $query =  self::$BASEQUERY ."
    AND s.id_prd_lectivo = :idPeriodo
    AND s.id_materia = :idMateria
    ". self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idPeriodo' => $aguja[0],
      'idMateria' => $aguja[1]
    ]);
  }

  static function buscarPorDoncente($identificacion){
    $query =  self::$BASEQUERY .'
    AND c.id_curso IN (
      SELECT id_curso
      FROM public."Cursos" cr,
      public."Docentes" d,
      public."Personas" p
      WHERE p.persona_identificacion = :identificacion
      AND d.id_persona = p.id_persona
      AND c.id_docente = d.id_docente
    )
    '. self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'identificacion' => $identificacion
    ]);
  }

  static function buscarPorCurso($id_curso){
    $query = self::$BASEQUERY . "
    AND c.id_curso = :idCurso
    ".self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'idCurso' => $id_curso
    ]);
  }

  static function buscarPorCursoNombrePeriodo($cursoNombre, $idPeriodo){
    $query = self::$BASEQUERY . "
    AND c.curso_nombre ILIKE :cursoNombre
    AND pl.id_prd_lectivo = :idPeriodo
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'cursoNombre' => '%'.$cursoNombre.'%',
      'idPeriodo' => $idPeriodo
    ]);
  }

  static function buscarSilabosPorPeriodo($idPeriodo){
    $query =  self::$BASEQUERY ."
    AND s.id_prd_lectivo = :idPeriodo
    ". self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idPeriodo' => $idPeriodo
    ]);
  }

  static function buscarSilabosPorMateria($idMateria){
    $query =  self::$BASEQUERY ."
    AND s.id_materia = :idMateria
    ". self::$ENDQUERY;

    return getArrayFromSQL($query, [
      'idMateria' => $idMateria
    ]);
  }

  static function cargarPDF($id_silabo) {
    $query =  '
    SELECT encode(documento_silabo, \'base64\') as pdf  FROM public."Silabo"
    WHERE id_silabo = :idSilabo';
    $res = getOneFromSQL($query, [
      'idSilabo' => $id_silabo
    ]);
    return $res['pdf'];
  }

  static function buscarActividadesSilabo($id_silabo) {
    $query = '
    SELECT
    numero_unidad,
    titulo_unidad,
    us.id_unidad,
    indicador,
    instrumento,
    valoracion,
    fecha_envio,
    fecha_presentacion
    FROM
    public."UnidadSilabo" us,
    public."EvaluacionSilabo" es
    WHERE
    us.id_silabo = :idSilabo AND
    es.id_unidad = us.id_unidad
    ORDER BY fecha_envio, fecha_presentacion;';
    return getArrayFromSQL($query, [
      'idSilabo' => $id_silabo
    ]);
  }

}

?>
