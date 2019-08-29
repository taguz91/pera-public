--Inserts para pruebas
INSERT INTO public."PermisoIngresoFichas"(
  id_prd_lectivo,
  id_tipo_ficha,
  permiso_ingreso_fecha_inicio,
  permiso_ingreso_fecha_fin)
VALUES (
  21,
  1,
  to_timestamp('25-08-2019 15:36:38', 'dd-mm-yyyy hh24:mi:ss'),
  to_timestamp('05-09-2019 15:36:38', 'dd-mm-yyyy hh24:mi:ss')
);
--- Id generado 6

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
VALUES (
  1,
  548,
  set_byte(MD5('hola') :: bytea, 4, 64)
);

--Debo ejecutar la funcion de tipo persona ANTES

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
SELECT 1, id_persona, set_byte(MD5('123') :: bytea, 4, 64)
FROM public."Personas"
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos"
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."Matricula"
    WHERE id_prd_lectivo = 21
  )
);
