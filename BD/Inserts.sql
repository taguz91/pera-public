INSERT INTO public."TipoFicha"(tipo_ficha, tipo_ficha_descripcion)
VALUES ('Ficha Libre Socioeconomica', 'Informacion sobre la ficha socioeconomica.');

INSERT INTO public."PermisoIngresoFichas" (
  id_prd_lectivo,
  id_tipo_ficha,
  permiso_ingreso_fecha_inicio,
  permiso_ingreso_fecha_fin
) VALUES (
  22, 1,
  '7/8/2019', '26/8/2019'
);


INSERT INTO public."UsersWeb" (
  id_persona, user_tipo, user_name,
  user_clave)
  VALUES (
    1, 'alumno',
    'taguz', md5('123')
  );

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave,
  persona_ficha_fecha_ingreso,
  persona_ficha_fecha_modificacion
) VALUES (
  2, 1,
  set_byte( MD5( '123' ) :: bytea, 4, 64 ),
  now(),
  now()
);

--Insertamos todos

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave,
  persona_ficha_fecha_ingreso,
  persona_ficha_fecha_modificacion
) SELECT
1, id_persona ,
set_byte( MD5( '123' ) :: bytea, 4, 64 ),
now(),
now()
FROM public."Personas";
  


---Para pruebas con tipos de preguntas libres
INSERT INTO public."SeccionesFicha" (
  id_tipo_ficha, seccion_ficha_nombre
) VALUES (
  1, 'Estudios de nivel medio'
);

INSERT INTO public."PreguntasFicha" (
  id_seccion_ficha,
  pregunta_ficha,
  pregunta_ficha_ayuda,
  pregunta_ficha_respuesta_tipo
) VALUES (
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Estudios de nivel medio'),
  'Colegio',
  'Colegio en el que termino sus estudios',
  3
),
(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Estudios de nivel medio'),
  'Tipo de colegio',
  'Tipo de colegio en el que termino sus estudios',
  3
),
(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Estudios de nivel medio'),
  'Titulo / Especialidad / Carrera',
  'El titulo en el que se graduo en el colegio',
  3
),
(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Estudios de nivel medio'),
  'Fecha inicio',
  'Fecha en la que inicio los estudios en el colegio',
  3
),
(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Estudios de nivel medio'),
  'Fecha finalizacion',
  'Fecha en la que termino sus estudios',
  3
);


--Para resolver las preguntas
INSERT INTO public."SeccionesFicha" (
  id_tipo_ficha, seccion_ficha_nombre
) VALUES (
  1, 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'
);


INSERT INTO public."PreguntasFicha" (
  id_seccion_ficha,
  pregunta_ficha,
  pregunta_ficha_ayuda,
  pregunta_ficha_respuesta_tipo
) VALUES (
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Tipo de bien',
  'Categoria del bien que posee',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'País',
  'País en el que tiene el bien',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Provincia',
  'Provincia en el que tiene el bien',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Ciudad',
  'Ciudad en el que tiene el bien',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Dirección',
  'Dirección en el que se encuentra el bien',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Fecha de Adquisición',
  'Fecha en la que adquirio el bien',
  4
),(
  (SELECT id_seccion_ficha
  FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Activos inmuebles de la unidad familiar y personales en el caso de ser independiente'),
  'Valor en USD',
  'Valor que pago por el bien',
  4
);
