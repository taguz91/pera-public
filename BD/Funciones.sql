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

--Funciones para consultar el pais
CREATE OR REPLACE FUNCTION consultar_pais(id_lugar_param INT)
RETURNS character varying(100) AS $consultar_pais$
DECLARE
  l_i INT := 0;
  id_lugar_con INT := 0;
  nivel INT := 0;
  nombre_lugar character varying(100);
BEGIN
  SELECT lugar_nivel INTO nivel
  FROM public."Lugares"
  WHERE id_lugar = id_lugar_param;

  id_lugar_con := id_lugar_param;

  FOR l_i IN 1..nivel
  loop

  SELECT id_lugar, lugar_nombre
  INTO id_lugar_con, nombre_lugar
  FROM public."Lugares"
  WHERE id_lugar_referencia = id_lugar_con;

  RAISE NOTICE 'Nombre lugar : % Nivel: %, Parametro: %, Foranea: %', nombre_lugar, nivel, id_lugar_param, id_lugar_con;

  END loop;

  RETURN nombre_lugar;
END;
$consultar_pais$ LANGUAGE plpgsql;
