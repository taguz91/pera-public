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


--Consultamos las secciones por id_persona_ficha
SELECT
sf.id_seccion_ficha,
sf.seccion_ficha_nombre
FROM
public."SeccionesFicha" sf
WHERE
sf.id_seccion_ficha NOT IN (
  SELECT DISTINCT id_seccion_ficha
  FROM public."AlumnoRespuestaFS" ar,
  public."RespuestaFicha" rf,
  public."PreguntasFicha" pf
  WHERE
  rf.id_respuesta_ficha = ar.id_respuesta_ficha AND
  pf.id_pregunta_ficha = rf.id_pregunta_ficha AND
  ar.id_persona_ficha =
) AND sf.id_seccion_ficha NOT IN (
  SELECT DISTINCT id_seccion_ficha
  FROM public."AlumnoRespuestaLibreFS" arl,
  public."RespuestaFicha" rf
  WHERE
  rf.id_pregunta_ficha = arl.id_pregunta_ficha AND
  arl.id_persona_ficha =
);

--Solo consultamos la seccion que le falte
SELECT
MIN(sf.id_seccion_ficha)
FROM
public."SeccionesFicha" sf
WHERE
sf.id_seccion_ficha NOT IN (
  SELECT DISTINCT id_seccion_ficha
  FROM public."AlumnoRespuestaFS" ar,
  public."RespuestaFicha" rf,
  public."PreguntasFicha" pf
  WHERE
  rf.id_respuesta_ficha = ar.id_respuesta_ficha AND
  pf.id_pregunta_ficha = rf.id_pregunta_ficha AND
  ar.id_persona_ficha =
) AND sf.id_seccion_ficha NOT IN (
  SELECT DISTINCT id_seccion_ficha
  FROM public."AlumnoRespuestaLibreFS" arl,
  public."RespuestaFicha" rf
  WHERE
  rf.id_pregunta_ficha = arl.id_pregunta_ficha AND
  arl.id_persona_ficha =
);

--Seleccionamos todas las secciones de una ficha por id_persona_ficha
SELECT id_tipo_ficha
FROM public."PermisoIngresoFichas" pif,
public."PersonaFicha" pf
WHERE
id_persona_ficha = 7 AND
pif.id_permiso_ingreso_ficha = pf.id_permiso_ingreso_ficha;

--Consultamos los usuarios
SELECT
uw.id_user_web,
p.id_persona,
p.persona_primer_nombre,
p.persona_segundo_nombre,
p.persona_primer_apellido,
p.persona_segundo_apellido,
p.persona_correo,
p.persona_celular
FROM public."UsersWeb" uw,
JOIN public."Personas" p ON uw.id_persona = p.id_persona
WHERE uw.id_user_web = ;
