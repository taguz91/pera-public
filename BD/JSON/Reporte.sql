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
          pregunta_ficha_respuesta_tipo
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
      persona_primer_nombre,
      persona_primer_apellido,
      persona_identificacion,
      persona_correo,
      persona_ficha_fecha_ingreso,
      persona_ficha_fecha_modificacion,

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
      )

      FROM public."PersonaFicha" perfi
      JOIN public."Personas" per ON
      perfi.id_persona = per.id_persona
      WHERE persona_activa = true AND
      perfi.id_permiso_ingreso_ficha = pifi.id_permiso_ingreso_ficha
    ) AS res
  )
  FROM public."PermisoIngresoFichas" pifi
  WHERE permiso_ingreso_activo = true AND
  id_permiso_ingreso_ficha = 6
) AS r;
