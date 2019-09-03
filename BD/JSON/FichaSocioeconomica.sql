--Informacion de alumno  

--Para reporte
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
      (
         SELECT array_to_json(
           array_agg(rl.*)
         ) AS respuestas_libre FROM (
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
        FROM public."AlumnoRespuestaFS" arfs
        JOIN public."RespuestaFicha" rfs ON arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
        WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
        id_persona_ficha = :idPersonaFicha1
      ) AS respuesta
      FROM public."PreguntasFicha" pf
      WHERE id_seccion_ficha = sf.id_seccion_ficha AND
      pregunta_ficha_activa = true
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
) AS s;
