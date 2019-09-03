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
					array_agg(r.*)
				) AS respuestas FROM (
					SELECT
					id_respuesta_ficha,
					respuesta_ficha
					FROM public."RespuestaFicha"
					WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
					respuesta_ficha_activa = true
				) AS r
			),
      (
        SELECT array_to_json(
          array_agg(rd.*)
        ) AS respuestas_docente FROM (
          SELECT
          id_docente_respuesta_fo,
          docente_fo_respuesta
          FROM public."DocenteRespuestaFO" dfo
          WHERE id_pregunta_ficha = pf.id_pregunta_ficha AND
          id_persona_ficha = 12
        ) AS rd
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
		WHERE id_persona_ficha = 12 AND
		pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
	)
) AS s;
