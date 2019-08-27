CREATE OR REPLACE FUNCTION llenar_usuarios_web()
RETURNS VOID AS $llenar_usuarios_web$
DECLARE
  reg RECORD;
  personas CURSOR FOR SELECT id_persona, persona_identificacion
  FROM public."Personas" WHERE persona_activa = true;
BEGIN
  OPEN personas;
  FETCH personas INTO reg;
  WHILE ( FOUND ) LOOP
    INSERT INTO public."UsersWeb" (
      id_persona, user_name, user_clave
    ) VALUES (
      reg.id_persona,
      reg.persona_identificacion,
      md5( md5('web') || reg.persona_identificacion || 'web')
    );
  FETCH personas INTO reg;
  END LOOP;
  RETURN;
END;
$llenar_usuarios_web$ LANGUAGE plpgsql;
