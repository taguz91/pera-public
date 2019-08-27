<?php

class CursoBD {

  static private $BASEQUERY = '
  SELECT
  pl.id_prd_lectivo,
  prd_lectivo_nombre,
  persona_primer_nombre,
  persona_primer_apellido,
  c.id_curso,
  curso_nombre,
  curso_ciclo,
  curso_capacidad,
  m.id_materia,
  materia_nombre
  FROM
  public."Cursos" c, public."Personas" p,
  public."Docentes" d, public."PeriodoLectivo" pl,
  public."Materias" m
  WHERE
  c.id_prd_lectivo = pl.id_prd_lectivo AND
  d.id_docente = c.id_docente AND
  p.id_persona = d.id_persona AND
  m.id_materia = c.id_materia
  ';
  static private $ENDQUERY = '
  AND curso_activo = true
  ORDER BY prd_lectivo_nombre
  ';

  function cargarCursos() {
    $query =  self::$BASEQUERY .' '. self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  function buscar($id_curso){
    $query = self::$BASEQUERY . "
      AND c.id_curso = :idCurso
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'idCurso' => $id_curso
    ]);
  }

  function buscarPorAlumno($aguja){
    $query = self::$BASEQUERY . '
      AND c.id_curso IN (
        SELECT id_curso
        FROM public."AlumnoCurso"
        WHERE id_alumno IN (
          SELECT id_alumno
          FROM public."Alumnos" a, public."Personas" p
          WHERE
          a.id_persona = p.id_persona AND (
            '.buscarPersona($aguja).'
          )
        )
      )
    ' . self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  function cargarPorDoncente($aguja){
    $query = self::$BASEQUERY . "
      AND (".buscarPersona($aguja).")
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  function cargarCursosPorPeriodo($id_periodo) {
    $query = self::$BASEQUERY . "
      AND c.id_prd_lectivo = :idPeriodo
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'idPeriodo' => $id_periodo
    ]);
  }

  function cargarCursosPorNombrePeriodo($curso_nombre, $id_periodo) {
    $query = self::$BASEQUERY . "
    AND c.curso_nombre ILIKE :cursoNombre
    AND c.id_prd_lectivo = :idPeriodo
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'cursoNombre' => '%'.$curso_nombre.'%',
      'idPeriodo' => $id_periodo
    ]);
  }

  function buscarCursos($aguja) {
    $query = self::$BASEQUERY."
    AND(curso_nombre ILIKE :aguja1 OR "
       . buscarPersona( $aguja ) . "OR
       materia_nombre ILIKE :aguja2
    )".' '. self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'aguja1' => '%'.$aguja.'%',
      'aguja2' => '%'.$aguja.'%'
    ]);
  }

  function cargarCursosNombrePorPeriodo($id_periodo){
    $query = '
    SELECT
    DISTINCT curso_nombre
    FROM
    public."Cursos" c
    WHERE
    c.id_prd_lectivo = :idPeriodo AND
    c.curso_activo = true
    ORDER BY curso_nombre;';
    return getArrayFromSQL($query, [
      'idPeriodo' => $id_periodo
    ]);
  }

  function cargarCursosMateriaPorNombrePeriodo($curso_nombre, $id_periodo){
    $query = "
    SELECT
    id_curso,
    materia_nombre
    FROM
    public.\"Cursos\" c,
    public.\"Materias\" m
    WHERE
    m.id_materia = c.id_materia AND
    c.curso_nombre ILIKE :cursoNombre AND
    c.id_prd_lectivo = :idPeriodo
    ORDER BY materia_nombre;";
    return getArrayFromSQL($query, [
      'cursoNombre' => '%'.$curso_nombre.'%',
      'idPeriodo' => $id_periodo
    ]);
  }

}

?>
