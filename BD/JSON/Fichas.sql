--Ejemplo
SELECT to_json(p.*)
FROM (
	SELECT id_persona, persona_primer_nombre
	FROM public."Personas" p WHERE id_persona = 548
) AS p;

SELECT array_to_json(array_agg(p.*))
FROM (
  SELECT
  id_persona,
  persona_primer_nombre,
  persona_primer_apellido
  FROM public."Personas" per
) AS p

--Solo las secciones de ficha

SELECT array_to_json(
  array_agg(s.*)
) FROM (
  SELECT
  id_seccion_ficha,
  id_tipo_ficha,
  seccion_ficha_nombre
  FROM public."SeccionesFicha"
) AS s;

--Con preguntas
SELECT array_to_json(
  array_agg(s.*)
) FROM (
  SELECT
  id_seccion_ficha,
  id_tipo_ficha,
  seccion_ficha_nombre,(
    SELECT array_to_json(
      array_agg(p.*)
    ) FROM (
      SELECT
      id_pregunta_ficha,
      pregunta_ficha
      FROM public."PreguntasFicha"
      WHERE id_seccion_ficha = sf.id_seccion_ficha
    ) AS p
  )
  FROM public."SeccionesFicha" sf
) AS s;

--Con respuestas
SELECT array_to_json(
  array_agg(s.*)
) FROM (
  SELECT
  id_seccion_ficha,
  id_tipo_ficha,
  seccion_ficha_nombre,(
    SELECT array_to_json(
      array_agg(p.*)
    ) FROM (
      SELECT
      id_pregunta_ficha,
      pregunta_ficha, (
        SELECT array_to_json(
          array_agg(r.*)
        ) FROM (
          SELECT
          id_respuesta_ficha,
          respuesta_ficha
          FROM public."RespuestaFicha"
          WHERE id_pregunta_ficha = pf.id_pregunta_ficha
        ) AS r
      )
      FROM public."PreguntasFicha" pf
      WHERE id_seccion_ficha = sf.id_seccion_ficha
    ) AS p
  )
  FROM public."SeccionesFicha" sf
) AS s;

--FInal que usaremos en nuestra APP
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
				SELECT id_respuesta_ficha
				FROM public."AlumnoRespuestaFS"
				WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
				id_persona_ficha = 10
			) AS respuesta, (
				SELECT id_almn_respuesta_fs
				FROM public."AlumnoRespuestaFS"
				WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
				id_persona_ficha = 10
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
    ) AS p
  )
  FROM public."SeccionesFicha" sf
) AS s;


--Obtener las secciones de ficha por persona
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
