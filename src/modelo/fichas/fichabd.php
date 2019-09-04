<?php

abstract class FichaBD {

  static function getPorPersona($idPersona){

    $sql = '
    SELECT
    tf.id_tipo_ficha,
    tf.tipo_ficha,
    pl.id_prd_lectivo,
    pl.prd_lectivo_nombre,
    pif.id_permiso_ingreso_ficha,
    pif.permiso_ingreso_fecha_inicio,
    pif.permiso_ingreso_fecha_fin,
    pf.id_persona_ficha,
    pf.persona_ficha_fecha_ingreso,
    pf.persona_ficha_fecha_modificacion,
    pf.persona_ficha_finalizada
    FROM
    public."PersonaFicha" pf,
    public."PermisoIngresoFichas" pif,
    public."TipoFicha" tf,
    public."PeriodoLectivo" pl
    WHERE
    pf.id_persona = :id AND
    pf.id_permiso_ingreso_ficha = pif.id_permiso_ingreso_ficha AND
    tf.id_tipo_ficha = pif.id_tipo_ficha AND
    pl.id_prd_lectivo = pif.id_prd_lectivo
    ORDER BY
    permiso_ingreso_fecha_fin DESC;
    ';

    return getArrayFromSQL($sql, [
      'id' => $idPersona
    ]);
  }

}

 ?>
