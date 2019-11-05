<?php

abstract class PersonaFichaBD {

  static function guardarPersonaFicha($pf) {
    return executeSQL(self::$INSERT, [
      'id_permiso_ingreso_ficha' => $pf['id_permiso_ingreso_ficha'],
      'id_persona' => $pf['id_persona'],
      'persona_ficha_clave' => $pf['clave']
    ]);
  }

  static function editarPersonaFicha($id, $clave){
    return executeSQL(self::$UPDATE, [
      'id' => $id,
      'persona_ficha_clave' => $clave
    ]);
  }

  static function eliminar($id) {
    deleteById(self::$DELETE, $id);
  }

  static function getMatricula($idPeriodo) {
    $sql = '
    SELECT
    id_matricula,
    id_alumno,
    id_prd_lectivo,
    matricula_fecha,
    matricula_tipo,
    matricula_activa
    FROM
    public."Matricula"
    WHERE
    matricula_activa = true AND
    id_prd_lectivo = :idPeriodo
    ORDER BY
    matricula_fecha DESC;';

    return getArrayFromSQL($sql, [
      'idPeriodo' => $idPeriodo
    ]);
  }

  static function getAll() {
    $sql = self::$BASEQUERY . ' ' . self::$ENDQUERY;
    return getArrayFromSQL($sql, []);
  }

  static function getPorPermiso($idPermiso) {
    $sql = self::$BASEQUERY . '
    AND pi.id_permiso_ingreso_ficha = :idPermiso ' . self::$ENDQUERY;
    return getArrayFromSQL($sql, [
      'idPermiso' => $idPermiso
    ]);
  }

  static function getParaInicio() {
    $sql = '
    SELECT
    pf.id_permiso_ingreso_ficha,
    pl.prd_lectivo_nombre,
    tf.tipo_ficha,
    pf.permiso_ingreso_fecha_fin, (
      SELECT
      COUNT(id_permiso_ingreso_ficha)
      FROM public."PersonaFicha"
      WHERE id_permiso_ingreso_ficha = pf.id_permiso_ingreso_ficha
    ) AS num_personas
    FROM
    public."PermisoIngresoFichas" pf
    JOIN public."PeriodoLectivo" pl ON pf.id_prd_lectivo = pl.id_prd_lectivo
    JOIN public."TipoFicha" tf ON tf.id_tipo_ficha = pf.id_tipo_ficha
    WHERE
    pf.permiso_ingreso_activo = true
    ORDER BY
    pf.permiso_ingreso_fecha_fin DESC,
    pl.prd_lectivo_nombre;';
    return getArrayFromSQL($sql, []);
  }

  static function getCorreosEst($idPermiso, $numCiclo) {
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
      WHERE id_permiso_ingreso_ficha = idPermiso2
    ) ORDER BY id_persona;';
    return getArrayFromSQL($sql, [
      'idPermiso1' => $idPermiso,
      'numCiclo' => $numCiclo,
      'idPermiso2' => $idPermiso
    ]);
  }

  static function getCorreosDoc($idPermiso, $numCiclo){
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
      SELECT id_persona FROM public.\"PersonaFicha\"
      WHERE id_permiso_ingreso_ficha = :idPermiso2
    ) ORDER BY id_persona;';

    return getArrayFromSQL($sql, [
      'idPermiso1' => $idPermiso,
      'numCiclo' => $numCiclo,
      'idPermiso2' => $idPermiso
    ]);
  }

  static function getPorId($id) {
    $sql = '
    SELECT
    pr.id_persona_ficha,
    pi.id_permiso_ingreso_ficha,
    p.id_persona,
    pr.persona_ficha_clave,
    pr.persona_ficha_fecha_ingreso,
    pr.persona_ficha_fecha_modificacion
    FROM
    public."PersonaFicha" pr,
    public."PermisoIngresoFichas" pi,
    public."Personas" p
    WHERE
    pr.id_permiso_ingreso_ficha = pi.id_permiso_ingreso_ficha
    AND pr.id_persona = p.id_persona
    AND pr.persona_ficha_activa = true
    AND id_persona_ficha = :id;';

    return getOneFromSQL($sql, [
      'id' => $id
    ]);
  }

  static function buscarPorNombre($aguja) {
    $sql = self::$BASEQUERY. "
    AND p.persona_primer_apellido
    ILIKE :aguja1 OR p.persona_segundo_apellido
    ILIKE :aguja2 OR p.persona_primer_nombre
    ILIKE :aguja3 OR p.persona_segundo_nombre
    ILIKE :aguja4 ".self::$ENDQUERY;

    return getArrayFromSQL($sql, [
      'aguja1' => '%'.$aguja.'%',
      'aguja2' => '%'.$aguja.'%',
      'aguja3' => '%'.$aguja.'%',
      'aguja4' => '%'.$aguja.'%'
    ]);
  }

  static function buscarPorCedula($aguja){
    $sql = self::$BASEQUERY. "
    AND p.persona_identificacion
    ILIKE :aguja ". self::$ENDQUERY;
    return getArrayFromSQL($sql, []);
  }

  public static $BASEQUERY = '
    SELECT
    pr.id_persona_ficha,
    p.id_persona,
    pr.persona_ficha_clave,
    pr.persona_ficha_fecha_ingreso,
    pr.persona_ficha_fecha_modificacion,
    p.persona_primer_nombre || \' \' ||
    p.persona_primer_apellido AS persona_nombre,
    p.persona_correo
    FROM
    public."PersonaFicha" pr,
    public."PermisoIngresoFichas" pi,
    public."Personas" p
    WHERE
    pr.id_permiso_ingreso_ficha = pi.id_permiso_ingreso_ficha
    AND pr.id_persona = p.id_persona
    AND pr.persona_ficha_activa = true ';

  public static $ENDQUERY = '
    ORDER BY
    pr.persona_ficha_fecha_ingreso DESC';

  public static $INSERT = '
    INSERT INTO public."PersonaFicha"(
      id_permiso_ingreso_ficha, id_persona, persona_ficha_clave, persona_ficha_activa)
    VALUES(
      :id_permiso_ingreso_ficha,
      :id_persona,
      set_byte( MD5(:persona_ficha_clave) :: bytea, 4, 64),
      true)';

  public static $UPDATE = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_clave = set_byte( MD5(:persona_ficha_clave) :: bytea, 4, 64)
    WHERE id_persona_ficha = :id;';

  public static $DELETE = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_activa = false
    WHERE id_persona_ficha = :id;';

}
