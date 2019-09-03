<?php

class ResFSBD {

    static function getAll() {
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
