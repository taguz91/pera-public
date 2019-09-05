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
