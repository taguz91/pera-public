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

  SELECT id_lugar_referencia, lugar_nombre
  INTO id_lugar_con, nombre_lugar
  FROM public."Lugares"
  WHERE id_lugar = id_lugar_con;

  END loop;

  RETURN nombre_lugar;
END;
$consultar_pais$ LANGUAGE plpgsql;

--Consultamos la provincia
CREATE OR REPLACE FUNCTION consultar_provincia(id_lugar_param INT)
RETURNS character varying(100) AS $consultar_pais$
BEGIN
  RETURN lugar_por_nivel(id_lugar_param, 2);
END;
$consultar_pais$ LANGUAGE plpgsql;

--Consultar la ciudad
CREATE OR REPLACE FUNCTION consultar_ciudad(id_lugar_param INT)
RETURNS character varying(100) AS $consultar_pais$
BEGIN
  RETURN lugar_por_nivel(id_lugar_param, 3);
END;
$consultar_pais$ LANGUAGE plpgsql;

--Consultar la parroquia
CREATE OR REPLACE FUNCTION consultar_parroquia(id_lugar_param INT)
RETURNS character varying(100) AS $consultar_pais$
BEGIN
  RETURN lugar_por_nivel(id_lugar_param, 4);
END;
$consultar_pais$ LANGUAGE plpgsql;

--Para consultar por nivel el lugar que necesitamos
CREATE OR REPLACE FUNCTION lugar_por_nivel(id_lugar_param INT, nivel_param INT)
RETURNS character varying(100) AS $consultar_pais$
DECLARE
  id_lugar_con INT := 0;
  nivel INT := 0;
  nombre_lugar character varying(100);
BEGIN
  id_lugar_con := id_lugar_param;

  WHILE nivel != nivel_param  LOOP
    SELECT id_lugar_referencia, lugar_nombre, lugar_nivel
    INTO id_lugar_con, nombre_lugar, nivel
    FROM public."Lugares"
    WHERE id_lugar = id_lugar_con;
  END LOOP;

  RETURN nombre_lugar;
END;
$consultar_pais$ LANGUAGE plpgsql;
