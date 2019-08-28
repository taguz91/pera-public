CREATE OR REPLACE FUNCTION tipo_persona(id_p INT)
RETURNS character varying(1) AS $tipo_persona$
DECLARE
  tipo character varying(1) := 'S';
  id_a INT := 0;
  id_d INT := 0;
BEGIN
  SELECT id_alumno INTO id_a
  FROM public."Alumnos"
  WHERE id_persona = id_p AND
  alumno_activo = true;

  SELECT id_docente INTO id_d
  FROM public."Docentes"
  WHERE id_persona = id_p AND
  docente_activo = true;

  IF id_a <> 0 THEN
    tipo := 'A';
  ELSEIF id_d <> 0 THEN
    tipo := 'D';
  END IF;
  RETURN tipo;
END;
$tipo_persona$ LANGUAGE plpgsql;
