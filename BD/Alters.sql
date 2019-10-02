--Agregando los tipos de datos que no tenemos en la tabla persona y modificando existentes
ALTER TABLE public."Personas" ALTER COLUMN "persona_sexo" TYPE character varying(10);


-- ALTER TABLE public."Personas" ADD COLUMN "persona_pasaporte" character varying(20);

ALTER TABLE public."Alumnos" ADD COLUMN "alumno_clase_social" character varying(30);
ALTER TABLE public."Alumnos" ADD COLUMN "alumno_email_cotacto_emergencia" character varying(50);

ALTER TABLE public."Personas" ADD COLUMN "persona_fecha_actualizacion" DATE;



--Tipo de dato
ALTER TABLE public."AlumnoRespuestaLibreFS" ALTER COLUMN "alumno_fs_libre" TYPE character varying(255);
