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
            SELECT id_respuesta_ficha
            FROM public."AlumnoRespuestaFS" arfs
            JOIN public."RespuestaFicha" rfs ON arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
            WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
            id_persona_ficha = perf.id_persona_ficha
          ) AS respuesta,

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

  FROM public."SeccionesFicha" sf
  WHERE seccion_ficha_activa = true AND
  sf.id_tipo_ficha = (
    SELECT id_tipo_ficha
    FROM public."PermisoIngresoFichas" pif
    JOIN public."PersonaFicha" prf ON
    pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
    WHERE persona_ficha_finalizada = true
  )
) AS s;
