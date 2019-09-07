SELECT array_to_json (
  array_agg(s.*)
) AS secciones FROM (
  SELECT
  seccion_ficha_nombre,

  (
    SELECT array_to_json(
      array_agg(preg.*)
    ) AS preguntas FROM (
      SELECT
      pregunta_ficha,
      pregunta_ficha_respuesta_tipo,

      (
        SELECT array_to_json(
          array_agg(pers.*)
        ) AS personas FROM (
          SELECT
          prd_lectivo_nombre,
          persona_primer_nombre,
          persona_primer_apellido,
          persona_identificacion,
          persona_correo,
          persona_ficha_fecha_ingreso,
          persona_ficha_fecha_modificacion,

          (
            SELECT array_to_json(
              array_agg(ru.*)
            ) AS respuesta FROM (
              SELECT respuesta_ficha
              FROM public."AlumnoRespuestaFS" arfs
              JOIN public."RespuestaFicha" rfs ON
              arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
              WHERE
              id_persona_ficha = perf.id_persona_ficha
            ) AS ru

          ), (
            SELECT array_to_json(
                array_agg(rl.*)
            ) AS respuestas FROM (
              SELECT
              alumno_fs_libre
              FROM public."AlumnoRespuestaLibreFS"
              arlfs
              WHERE arlfs.id_persona_ficha = perf.id_persona_ficha
            ) AS rl
          )

          FROM
          public."Personas" pe
          JOIN public."PersonaFicha" perf ON
          pe.id_persona = perf.id_persona
          JOIN public."PermisoIngresoFichas" pif ON
          perf.id_permiso_ingreso_ficha = pif.id_permiso_ingreso_ficha
          JOIN public."PeriodoLectivo" pl ON
          pl.id_prd_lectivo = pif.id_prd_lectivo
          WHERE persona_ficha_finalizada = true AND
          persona_ficha_activa = true

        ) AS pers
      )

    FROM public."PreguntasFicha"
    WHERE id_seccion_ficha = sf.id_seccion_ficha

    ) AS preg
  )

  FROM public."SeccionesFicha" sf
  WHERE seccion_ficha_activa = true AND
  sf.id_tipo_ficha = (
    SELECT DISTINCT id_tipo_ficha
    FROM public."PermisoIngresoFichas" pif
    JOIN public."PersonaFicha" prf ON
    pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
    WHERE persona_ficha_finalizada = true AND
    id_prd_lectivo = 21
  )
) AS s;
