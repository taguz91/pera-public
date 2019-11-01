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

--- Persona ficha

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
    WHERE id_prd_lectivo = 31
  )
) AND id_persona NOT IN (
	SELECT id_persona
	FROM public."PersonaFicha" pf
	WHERE pf.id_permiso_ingreso_ficha = 1
);

-- Personas ficha de EDTS 32 Permiso 2

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
SELECT 2, id_persona, set_byte(MD5('321') :: bytea, 4, 64)
FROM public."Personas"
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos"
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."Matricula"
    WHERE id_prd_lectivo = 32
  )
) AND id_persona NOT IN (
	SELECT id_persona
	FROM public."PersonaFicha" pf
	WHERE pf.id_permiso_ingreso_ficha = 2
);

-- Persona ficha TSMI 33 Permiso 3


INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
SELECT 3, id_persona, set_byte(MD5('1234') :: bytea, 4, 64)
FROM public."Personas"
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos"
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."Matricula"
    WHERE id_prd_lectivo = 33
  )
) AND id_persona NOT IN (
	SELECT id_persona
	FROM public."PersonaFicha" pf
	WHERE pf.id_permiso_ingreso_ficha = 3
);

-- Persona ficha TSE 35 Permiso 4

INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
SELECT 4, id_persona, set_byte(MD5('4321') :: bytea, 4, 64)
FROM public."Personas"
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos"
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."Matricula"
    WHERE id_prd_lectivo = 35
  )
) AND id_persona NOT IN (
	SELECT id_persona
	FROM public."PersonaFicha" pf
	WHERE pf.id_permiso_ingreso_ficha = 4
);

-- Persona ficha DII 36 Permiso 5


INSERT INTO public."PersonaFicha"(
  id_permiso_ingreso_ficha,
  id_persona,
  persona_ficha_clave)
SELECT 5, id_persona, set_byte(MD5('12345') :: bytea, 4, 64)
FROM public."Personas"
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos"
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."Matricula"
    WHERE id_prd_lectivo = 36
  )
) AND id_persona NOT IN (
	SELECT id_persona
	FROM public."PersonaFicha" pf
	WHERE pf.id_permiso_ingreso_ficha = 5
);
