<?php
require_once 'src/modelo/fichas/preguntabd.php';

abstract class SeccionBD {

  private static $BASESELECT = '
  SELECT
  sf.id_seccion_ficha,
  seccion_ficha_nombre
  FROM
  public."SeccionesFicha" sf
  WHERE
  seccion_ficha_activa = true';

  static function getFSPorIDPersonaFicha($idPersonaFicha){
    $sql = '
    SELECT array_to_json(
      array_agg(s.*)
    ) AS secciones FROM (
      SELECT
      id_seccion_ficha,
      id_tipo_ficha,
      seccion_ficha_nombre,(
        SELECT array_to_json(
          array_agg(p.*)
        ) AS preguntas FROM (
          SELECT
          id_pregunta_ficha,
          pregunta_ficha,
    			pregunta_ficha_ayuda,
    			pregunta_ficha_tipo,
    			pregunta_ficha_respuesta_tipo,
          pregunta_ficha_respuesta_campo,

    			(
    				 SELECT array_to_json(
    					 array_agg(rl.*)
    				 ) AS respuesta_libre FROM (
    					 SELECT
    					 id_almn_respuesta_libre_fs,
    					 alumno_fs_libre
    					 FROM public."AlumnoRespuestaLibreFS" arl
    					 WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
    					 id_persona_ficha = :idPersonaFicha4
    				 ) AS rl
    			),

    			(
    				SELECT id_respuesta_ficha
    				FROM public."AlumnoRespuestaFS"
    				WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
    				id_persona_ficha = :idPersonaFicha1
    			) AS respuesta, (
    				SELECT id_almn_respuesta_fs
    				FROM public."AlumnoRespuestaFS"
    				WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
    				id_persona_ficha = :idPersonaFicha2
    			) AS actualizar, (
            SELECT array_to_json(
              array_agg(r.*)
            ) AS respuestas FROM (
              SELECT
              id_respuesta_ficha,
              respuesta_ficha
              FROM public."RespuestaFicha"
              WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
              respuesta_ficha_activa = true
            ) AS r
          )
          FROM public."PreguntasFicha" pf
          WHERE id_seccion_ficha = sf.id_seccion_ficha AND
          pregunta_ficha_activa = true
          ORDER BY pregunta_ficha_posicion
        ) AS p
      )
      FROM public."SeccionesFicha" sf
      WHERE seccion_ficha_activa = true AND
      sf.id_tipo_ficha = (
        SELECT id_tipo_ficha
        FROM public."PermisoIngresoFichas" pif,
        public."PersonaFicha" prf
        WHERE id_persona_ficha = :idPersonaFicha3 AND
        pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
      )
      ORDER BY seccion_ficha_posicion
    ) AS s;';
    return getOneFromSQL($sql, [
      'idPersonaFicha1' => $idPersonaFicha,
      'idPersonaFicha2' => $idPersonaFicha,
      'idPersonaFicha3' => $idPersonaFicha,
      'idPersonaFicha4' => $idPersonaFicha
    ]);
  }

  static function getPorIdPersonaFichaOLD($idPersonaFicha){
    $sql = self::$BASESELECT . ' AND sf.id_tipo_ficha = (
      SELECT id_tipo_ficha
      FROM public."PermisoIngresoFichas" pif,
      public."PersonaFicha" pf
      WHERE
      id_persona_ficha = '.$idPersonaFicha.' AND
      pif.id_permiso_ingreso_ficha = pf.id_permiso_ingreso_ficha
    );';

    $secciones = getArrayFromSQL($sql, []);
    $newsecciones = [];
    if(!isset($secciones['error'])){
      foreach ($secciones as $s) {
        $preguntas = PreguntaBD::getPorIdSeccionIdPersonaFicha($s['id_seccion_ficha'], $idPersonaFicha);
        if(!isset($preguntas['error'])){
          $s += ['preguntas' => $preguntas];
          array_push($newsecciones, $s);
        }
      }
    }

    return $newsecciones;
  }


  static function getSeccionFaltante($idPersonaFicha){
    $ct = getCon();

    $sql = self::$BASESELECT . ' AND id_seccion_ficha = (
      SELECT
      MIN(sf.id_seccion_ficha)
      FROM
      public."SeccionesFicha" sf
      WHERE
      sf.id_seccion_ficha NOT IN (
        SELECT DISTINCT id_seccion_ficha
        FROM public."AlumnoRespuestaFS" ar,
        public."RespuestaFicha" rf,
        public."PreguntasFicha" pf
        WHERE
        rf.id_respuesta_ficha = ar.id_respuesta_ficha AND
        pf.id_pregunta_ficha = rf.id_pregunta_ficha AND
        ar.id_persona_ficha = '.$idPersonaFicha.'
      ) AND sf.id_seccion_ficha NOT IN (
        SELECT DISTINCT id_seccion_ficha
        FROM public."AlumnoRespuestaLibreFS" arl,
        public."RespuestaFicha" rf
        WHERE
        rf.id_pregunta_ficha = arl.id_pregunta_ficha AND
        arl.id_persona_ficha = '.$idPersonaFicha.'
      )
    );';

    return self::getSecciones($sql, $idPersonaFicha);
  }

  static function getJSON(){
    $sql = '
    SELECT array_to_json(
      array_agg(a.*)
    ) AS alumnos FROM (
      SELECT
      per.id_persona,
      consultar_pais(id_lugar_natal) AS pais_nacimiento,
      consultar_provincia(id_lugar_natal) AS provincia_nacimiento,
      consultar_ciudad(id_lugar_natal) AS ciudad_nacimiento,
      consultar_parroquia(id_lugar_natal) AS parroquia_nacimiento,
      consultar_pais(id_lugar_residencia) AS pais_residencia,
      consultar_provincia(id_lugar_residencia) AS
      provincia_residencia,
      consultar_ciudad(id_lugar_residencia) AS
      ciudad_residencia,
      consultar_parroquia(id_lugar_residencia) AS
      parroquia_residencia,
      persona_identificacion,
      persona_primer_apellido,
      persona_segundo_apellido,
      persona_primer_nombre,
      persona_segundo_nombre,
      persona_genero,
      persona_sexo,
      persona_estado_civil,
      persona_etnia,
      persona_idioma_raiz,
      persona_tipo_sangre,
      persona_telefono,
      persona_celular,
      persona_correo,
      persona_fecha_registro,
      persona_discapacidad,
      persona_tipo_discapacidad,
      persona_porcenta_discapacidad, persona_carnet_conadis,
      persona_calle_principal,
      persona_numero_casa,
      persona_calle_secundaria,
      persona_referencia,
      persona_sector,
      persona_idioma,
      persona_tipo_residencia,
      persona_fecha_nacimiento,
      persona_activa,
      persona_categoria_migratoria, (
        SELECT array_to_json (
          array_agg(f.*)
        ) AS ficha FROM (
          SELECT
          tipo_ficha,
          tipo_ficha_descripcion
          FROM public."TipoFicha" tf
          JOIN public."PermisoIngresoFichas" pif ON
          pif.id_tipo_ficha = tf.id_tipo_ficha
          JOIN public."PersonaFicha" prf ON
          pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
          WHERE prf.id_persona_ficha = 10
        ) AS f
      ), (
        SELECT array_to_json (
          array_agg(s.*)
        ) AS secciones FROM (
          SELECT
          seccion_ficha_nombre, (
            SELECT array_to_json(
              array_agg(p.*)
            ) AS preguntas FROM (
              SELECT
              pregunta_ficha,
              pregunta_ficha_tipo, (
                SELECT array_to_json(
                  array_agg(rl.*)
                ) respuesta FROM (
                  SELECT
                  respuesta_ficha
                  FROM
                  public."AlumnoRespuestaFS" arfs
                  JOIN public."RespuestaFicha" rfs ON
                  arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
                  WHERE arfs.id_pregunta_ficha = pf.id_pregunta_ficha AND
                  arfs.id_persona_ficha = prf.id_persona_ficha
                ) AS rl
              ) , (
                SELECT array_to_json(
                  array_agg(rl.*)
                ) AS respuesta_libre FROM (
                  SELECT
                  alumno_fs_libre
                  FROM public."AlumnoRespuestaLibreFS" arlfs
                  WHERE
                  arlfs.id_pregunta_ficha = pf.id_pregunta_ficha  AND
                  arlfs.id_persona_ficha = prf.id_persona_ficha
                ) AS rl
              )
              FROM public."PreguntasFicha" pf
              WHERE id_seccion_ficha = sf.id_seccion_ficha AND
              pregunta_ficha_activa = true
            ) AS p
          )
          FROM public."SeccionesFicha" sf
          JOIN public."PermisoIngresoFichas" pif ON
          pif.id_tipo_ficha = sf.id_tipo_ficha
          JOIN public."PersonaFicha" prf ON
          pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
          WHERE seccion_ficha_activa = true AND
          prf.id_persona_ficha = 10
        ) as s
      )
      FROM public."Personas" per
      JOIN public."Alumnos" alu ON
      alu.id_persona =  per.id_persona
      WHERE persona_activa = true AND
      per.id_persona = 548
    ) AS a;
';
    $idPersonaFicha = 14;
    return getOneFromSQL($sql, []);
  }

  static function getRep(){
    $sql = '
    SELECT array_to_json (
      array_agg(r.*)
    ) AS reportes FROM (
      SELECT
      id_permiso_ingreso_ficha,
      id_prd_lectivo,

      (
        SELECT array_to_json(
          array_agg(sf.*)
        ) AS secciones_ficha FROM (
          SELECT
          seccion_ficha_nombre,

          (
            SELECT array_to_json(
              array_agg(rf.*)
            ) AS respuestas_ficha FROM (
              SELECT pregunta_ficha,
              pregunta_ficha_respuesta_tipo,
              pfi.id_pregunta_ficha
              FROM public."PreguntasFicha" pfi
              WHERE pfi.pregunta_ficha_activa = true AND
              pfi.id_seccion_ficha = sfi.id_seccion_ficha
              ORDER BY pregunta_ficha_posicion
            ) AS rf
          )

          FROM public."SeccionesFicha" sfi
          WHERE seccion_ficha_activa = true AND
          sfi.id_tipo_ficha = pifi.id_tipo_ficha
          ORDER BY seccion_ficha_posicion
        ) AS sf
      ),

      (
        SELECT array_to_json(
          array_agg(res.*)
        ) AS respuestas FROM (
          SELECT
          id_persona_ficha,
          (
            SELECT array_to_json(
              array_agg(iper.*)
            ) AS persona FROM (
              SELECT
              persona_identificacion,
              persona_primer_apellido,
              persona_segundo_apellido,
              persona_primer_nombre,
              persona_segundo_nombre,
              consultar_pais(id_lugar_natal) AS pais_nacimiento,
              consultar_provincia(id_lugar_natal) AS provincia_nacimiento,
              consultar_ciudad(id_lugar_natal) AS ciudad_nacimiento,
              consultar_parroquia(id_lugar_natal) AS parroquia_nacimiento,
              consultar_pais(id_lugar_residencia) AS pais_residencia,
              consultar_provincia(id_lugar_residencia) AS
              provincia_residencia,
              consultar_ciudad(id_lugar_residencia) AS
              ciudad_residencia,
              consultar_parroquia(id_lugar_residencia) AS
              parroquia_residencia,
              persona_genero,
              persona_sexo,
              persona_estado_civil,
              persona_etnia,
              persona_idioma_raiz,
              persona_tipo_sangre,
              persona_telefono,
              persona_celular,
              persona_correo,
              persona_discapacidad,
              persona_tipo_discapacidad,
              persona_porcenta_discapacidad, persona_carnet_conadis,
              persona_calle_principal,
              persona_calle_secundaria,
              persona_referencia,
              persona_sector,
              persona_numero_casa,
              persona_idioma,
              persona_tipo_residencia,
              persona_fecha_nacimiento,
              persona_categoria_migratoria,
              persona_ficha_fecha_ingreso,
              persona_ficha_fecha_modificacion
              FROM public."Personas" per
              WHERE
              per.id_persona = perfi.id_persona AND
              persona_activa = true
            ) AS iper

          ),

          (
            SELECT array_to_json(
              array_agg(pa.*)
            ) AS preguntas FROM (
              SELECT
              id_pregunta_ficha,

              (
                SELECT array_to_json (
                  array_agg(rl.*)
                ) AS res_libre FROM (
                  SELECT
                  alumno_fs_libre
                  FROM
                  public."AlumnoRespuestaLibreFS" alrl
                  WHERE alrl.id_persona_ficha = perfi.id_persona_ficha AND
                  alrl.id_pregunta_ficha = pfpa.id_pregunta_ficha
                ) AS rl
              ),

              (
                SELECT array_to_json(
                  array_agg(ru.*)
                ) AS pre_unica FROM (
                  SELECT
                  respuesta_ficha
                  FROM public."AlumnoRespuestaFS" arfs
                  JOIN public."RespuestaFicha" rfs ON
                  arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
                  WHERE arfs.id_persona_ficha =
                  perfi.id_persona_ficha AND
                  arfs.id_pregunta_ficha = pfpa.id_pregunta_ficha

                ) AS ru
              )


              FROM public."SeccionesFicha" sfpa
              JOIN public."PreguntasFicha" pfpa ON
              sfpa.id_seccion_ficha = pfpa.id_seccion_ficha
              WHERE sfpa.id_tipo_ficha = pifi.id_tipo_ficha AND
              sfpa.seccion_ficha_activa = true AND
              pfpa.pregunta_ficha_activa = true
              ORDER BY
              seccion_ficha_posicion,
              pregunta_ficha_posicion
            ) AS pa
          )

          FROM public."PersonaFicha" perfi
          JOIN public."Personas" per ON
          per.id_persona = perfi.id_persona
          WHERE
          perfi.id_permiso_ingreso_ficha = pifi.id_permiso_ingreso_ficha
          ORDER BY persona_primer_apellido,
          persona_segundo_apellido,
          persona_primer_nombre,
          persona_segundo_nombre
        ) AS res
      )
      FROM public."PermisoIngresoFichas" pifi
      WHERE permiso_ingreso_activo = true AND
      id_permiso_ingreso_ficha = 2
    ) AS r;';
    return getOneFromSQL($sql, []);
  }

}

 ?>
