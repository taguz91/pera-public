--Consultamos la ficha por persona
--Todas las fichas de una persona
SELECT
tf.id_tipo_ficha,
tf.tipo_ficha,
pl.id_prd_lectivo,
pl.prd_lectivo_nombre,
pif.id_permiso_ingreso_ficha,
pif.permiso_ingreso_fecha_inicio,
pif.permiso_ingreso_fecha_fin,
pf.id_persona_ficha,
pf.id_persona,
pf.persona_ficha_fecha_ingreso,
pf.persona_ficha_fecha_modificacion
FROM
public."PersonaFicha" pf,
public."PermisoIngresoFichas" pif,
public."TipoFicha" tf,
public."PeriodoLectivo" pl
WHERE
pf.id_persona = 1 AND
pf.id_permiso_ingreso_ficha = pif.id_permiso_ingreso_ficha AND
tf.id_tipo_ficha = pif.id_tipo_ficha AND
pl.id_prd_lectivo = pif.id_prd_lectivo


--Consultamos las secciones de una ficha
SELECT
sf.id_seccion_ficha,
seccion_ficha_nombre
FROM
public."SeccionesFicha" sf
WHERE
sf.id_tipo_ficha = 1;

--Consultamos las preguntas de una seccion
SELECT
pf.id_pregunta_ficha,
pf.pregunta_ficha,
pf.pregunta_ficha_ayuda
FROM
public."PreguntasFicha" pf
WHERE
pf.id_seccion_ficha = 19

--Consultamos las respuesta de la pregunta
SELECT
rf.id_respuesta_ficha,
rf.respuesta_ficha
FROM
public."RespuestaFicha" rf
WHERE
rf.id_pregunta_ficha = 26
