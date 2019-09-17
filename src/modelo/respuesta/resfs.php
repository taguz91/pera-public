<?php

class ResFSBD {

    static function getAll($idPermiso) {
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
                array_agg(gs.*)
              ) AS gruposocioeconomico FROM (
                SELECT grupo_socioeconomico,
                puntaje_minimo, puntaje_maximo, (
                  SELECT SUM(respuesta_almn_puntaje)
                  FROM public."AlumnoRespuestaFS"
                  WHERE id_persona_ficha = perfi.id_persona_ficha
                ) AS puntaje_alumno
                FROM public."GrupoSocioeconomico"
                WHERE puntaje_minimo >= (
                  SELECT SUM(respuesta_almn_puntaje)
                  FROM public."AlumnoRespuestaFS"
                  WHERE id_persona_ficha = perfi.id_persona_ficha
                )
                ORDER BY puntaje_maximo
                LIMIT 1
              ) AS gs
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
                    ORDER BY alumno_fs_fecha_ingreso
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
            per.id_persona = perfi.id_persona AND
            persona_ficha_finalizada = true
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
        id_permiso_ingreso_ficha = :idPermiso
      ) AS r;';
      return getOneFromSQL($sql, [
        'idPermiso' => $idPermiso
      ]);
    }


}

 ?>
