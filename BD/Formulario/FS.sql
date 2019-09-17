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
           ORDER BY alumno_fs_fecha_ingreso
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
          ORDER BY
          respuesta_ficha_puntaje
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
    pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha AND
    prf.id_persona = :idPersona
  )
  ORDER BY seccion_ficha_posicion
) AS s;
