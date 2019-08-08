INSERT INTO public."PermisoIngresoFichas" (
  id_prd_lectivo,
  id_tipo_ficha,
  permiso_ingreso_fecha_inicio,
  permiso_ingreso_fecha_fin
) VALUES (
  21, 1,
  '7/3/2019', '26/3/2019'
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
  1, 1,
  set_byte( MD5( '123' ) :: bytea, 4, 64 ),
  now(),
  now()
);
