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
        ) AS rf
      )

      FROM public."SeccionesFicha" sfi
      WHERE seccion_ficha_activa = true
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
          array_agg(pl.*)
        ) AS pre_libre FROM (

          SELECT
          alpl.id_pregunta_ficha, (
            SELECT array_to_json (
              array_agg(rl.*)
            ) AS res_libre FROM (
              SELECT
              alumno_fs_libre
              FROM
              public."AlumnoRespuestaLibreFS" alrl
              WHERE alrl.id_persona_ficha = perfi.id_persona_ficha AND
              alrl.id_pregunta_ficha = alpl.id_pregunta_ficha
            ) AS rl
          )
          FROM
          public."AlumnoRespuestaLibreFS" alpl
          WHERE alpl.id_persona_ficha = perfi.id_persona_ficha
          GROUP BY
          alpl.id_pregunta_ficha
        ) AS pl
      ),

      (
        SELECT array_to_json(
          array_agg(ru.*)
        ) AS pre_unica FROM (
          SELECT
          arfs.id_pregunta_ficha,
          respuesta_ficha
          FROM public."AlumnoRespuestaFS" arfs
          JOIN public."RespuestaFicha" rfs ON
          arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
          WHERE arfs.id_persona_ficha =
          perfi.id_persona_ficha
        ) AS ru
      )

      FROM public."PersonaFicha" perfi
      WHERE
      perfi.id_permiso_ingreso_ficha = pifi.id_permiso_ingreso_ficha
    ) AS res
  )
  FROM public."PermisoIngresoFichas" pifi
  WHERE permiso_ingreso_activo = true AND
  id_permiso_ingreso_ficha = 6
) AS r;
