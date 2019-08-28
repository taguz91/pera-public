--Inserts para pruebas
INSERT INTO public."PermisoIngresoFichas"(
  id_prd_lectivo,
  id_tipo_ficha,
  permiso_ingreso_fecha_inicio,
  permiso_ingreso_fecha_fin)
VALUES (
  21,
  1,
  '25/8/2019',
  '10/9/2019'
);
--- Id generado 6

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
VALUES (
  6,
  548,
  set_byte(MD5('123') :: bytea, 4, 64)
);
