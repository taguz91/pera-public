--Para crear todas las respuestas al ingresar un persona_ficha
CREATE OR REPLACE FUNCTION iniciar_ficha_alumno()
RETURNS TRIGGER AS $iniciar_ficha_alumno$
DECLARE
  tipo character varying(10) := 'S';

  reg RECORD;
  c_preguntas CURSOR FOR SELECT id_pregunta_ficha, pregunta_ficha_respuesta_tipo
  FROM public."PreguntasFicha"
  WHERE id_seccion_ficha IN (
    SELECT id_seccion_ficha
    FROM public."SeccionesFicha"
    WHERE id_tipo_ficha = (
      SELECT id_tipo_ficha
      FROM public."PermisoIngresoFichas"
      WHERE id_permiso_ingreso_ficha = new.id_permiso_ingreso_ficha
    )
  );
BEGIN

  RAISE NOTICE 'ID persona: %', new.id_persona;

  SELECT tipo_persona(new.id_persona) INTO tipo;
  RAISE NOTICE 'Tipo : %  Ide persona: %', tipo, new.id_persona;

  OPEN c_preguntas;
  FETCH c_preguntas INTO reg;
  WHILE ( FOUND ) LOOP
    --1 es tipo de respuesta UNICA
    IF tipo = 'A' AND
    reg.pregunta_ficha_respuesta_tipo = 1 THEN
      INSERT INTO public."AlumnoRespuestaFS" (
        id_persona_ficha, id_pregunta_ficha
      ) VALUES (
        new.id_persona_ficha, reg.id_pregunta_ficha
      );
    ELSEIF tipo = 'A' THEN

    ELSEIF tipo = 'D' THEN

    END IF;
    FETCH c_preguntas INTO reg;
  END LOOP;
  CLOSE c_preguntas;
  RETURN NEW;
END;
$iniciar_ficha_alumno$ LANGUAGE plpgsql;

CREATE TRIGGER ficha_alumno
AFTER INSERT ON public."PersonaFicha" FOR EACH ROW
EXECUTE PROCEDURE iniciar_ficha_alumno();


--Para actualizar la fecha
CREATE OR REPLACE FUNCTION fecha_persona_ficha()
RETURNS TRIGGER AS $fecha_persona_ficha$
BEGIN
  IF old.persona_ficha_fecha_ingreso IS NOT NULL THEN
    new.persona_ficha_fecha_modificacion := new.persona_ficha_fecha_ingreso;
    new.persona_ficha_fecha_ingreso := old.persona_ficha_fecha_ingreso;
  ELSE
    new.persona_ficha_fecha_ingreso := now();
  END IF;
  RETURN NEW;
END;
$fecha_persona_ficha$ LANGUAGE plpgsql;

CREATE TRIGGER actualiza_fecha
BEFORE UPDATE OF persona_ficha_fecha_ingreso
ON public."PersonaFicha" FOR EACH ROW
EXECUTE PROCEDURE fecha_persona_ficha();


--Para generar las respuestas automaticamente
DROP TRIGGER ficha_alumno ON public."PersonaFicha";
