INSERT INTO public."TipoFicha"(tipo_ficha, tipo_ficha_descripcion)
VALUES ('Ficha Socioeconómica', 'Nivel socioeconómico.');

--Para las preguntas
INSERT INTO public."SeccionesFicha"(
  id_tipo_ficha, seccion_ficha_nombre)
VALUES
(1, 'Características de la Vivienda'),
(1, 'Acceso a Tecnología'),
(1, 'Posesión de Bienes'),
(1, 'Hábitos de Consumo'),
(1, 'Nivel de Educación'),
(1, 'Actividad Económica del Hogar');

INSERT INTO public."PreguntasFicha"(
  id_seccion_ficha, pregunta_ficha,
  pregunta_ficha_ayuda)
VALUES
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
   'Cuál es el tipo de vivienda?',
'Tipo de vivienda.'),
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
  'El material predominante de las paredes exteriores de la vivienda es de:',
'Material de la vivienda'),
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
  'El material predominante al piso de la vivienda es de:',
'Material unicamente del piso.'),
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
  '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?',
'Duchas que unicamente usan sus familiares.'),
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
  'El tipo de servicio higiénico con que cuenta este hogar es:',
'Tipo de servicios');





INSERT INTO public."RespuestaFicha"(
  id_pregunta_ficha, respuesta_ficha,
  respuesta_ficha_puntaje)
VALUES
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Suite de lujo', 59),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Departamento en casa o edificio', 59),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Casa/Villa', 59),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Media agua', 40),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Rancho', 4),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Choza/Covacha/Otro', 0);



---NO tocan
INSERT INTO public."GrupoSocioeconomico"(
  id_tipo_ficha, grupo_socioeconomico,
  puntaje_minimo, puntaje_maximo)
VALUES
(1, 'A (Alto)', 845.10, 1000),
(1, 'B (Medio alto)', 696.10, 845),
(1, 'C+ (Medio tipico)', 535.10, 696),
(1, 'C- (Medio bajo)', 316.10, 535),
(1, 'D (Bajo)', 0, 316);



--Respuesta
INSERT INTO public."RespuestaFicha"(
  id_pregunta_ficha, respuesta_ficha,
  respuesta_ficha_puntaje)
VALUES
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'),
  'Hormigon', 59),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'), 'Ladrillo o bloque', 55),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'), 'Adobe/Tapia', 47),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'), 'Caña revestida o bahareque/Madera', 17),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante de las paredes exteriores de la vivienda es de:'), 'Caña no revestida/Otros materiales', 0);



--Pregunta El material predominante del piso de la vivienda es de:
INSERT INTO public."PreguntasFicha"(
  id_seccion_ficha, pregunta_ficha,
  pregunta_ficha_ayuda)
VALUES
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
   'El material predominante del piso de la vivienda es de:',
   'Tipo de material del piso de su vivienda.');

--Respuesta
INSERT INTO public."RespuestaFicha"(
  id_pregunta_ficha, respuesta_ficha,
  respuesta_ficha_puntaje)
VALUES
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha ILIKE 'El material predominante del piso de la vivienda es de:'),
  'Duela,parquet,tablón o piso flotante', 48),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante del piso de la vivienda es de:'), 'Cerámica,baldosa,vinil o marmetón', 46),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante del piso de la vivienda es de:'), 'Ladrillo o cemento', 34),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante del piso de la vivienda es de:'), 'Tabla sin tratar', 34),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El material predominante del piso de la vivienda es de:'), 'Tierra/Caña/Otros materiales', 32);


--Pregunta El material predominante del piso de la vivienda es de:
INSERT INTO public."PreguntasFicha"(
  id_seccion_ficha, pregunta_ficha,
  pregunta_ficha_ayuda)
VALUES
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
   '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?',
   'Cuartos de baño de uso exclusivo que tiene su hogar.');

--Respuesta
INSERT INTO public."RespuestaFicha"(
  id_pregunta_ficha, respuesta_ficha,
  respuesta_ficha_puntaje)
VALUES
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?'),
  'No tiene cuarto de baño exclusivo con ducha en el hogar', 0),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?'),
  'Tiene 1 cuarto de baño exclusivo con ducha', 12),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?'),
  'Tiene 2 cuartos de baño exclusivos con ducha', 24),
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = '¿Cuántos cuartos de baño con ducha de uso exclusivo tiene este hogar?'),
  'Tiene 3 o mas cuartos de baño exclusivos con ducha', 32);


--El tipo de servicio higienico con que cuenta este hogar es:
INSERT INTO public."PreguntasFicha"(
  id_seccion_ficha, pregunta_ficha,
  pregunta_ficha_ayuda)
VALUES
(
  (SELECT id_seccion_ficha FROM public."SeccionesFicha"
  WHERE seccion_ficha_nombre = 'Características de la Vivienda'),
   'El tipo de servicio higiénico con que cuenta este hogar es:',
   'Tipo de servicio higienico que dispone en su hogar.');

--Respuesta
INSERT INTO public."RespuestaFicha"(
  id_pregunta_ficha, respuesta_ficha,
  respuesta_ficha_puntaje)
VALUES
(
  (SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:'),
  'No tiene', 0),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:'),
  'Letrina', 15),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:')
  , 'Con descarga directa al mar,río,lago o quebrada', 18),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:'),
   'Conectado a pozo ciego', 18),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:')
  , 'Conectado a pozo séptico', 22),
((SELECT id_pregunta_ficha FROM public."PreguntasFicha"
  WHERE pregunta_ficha = 'El tipo de servicio higiénico con que cuenta este hogar es:'),
  'Conectado a red pública de alcantarillado', 38);
