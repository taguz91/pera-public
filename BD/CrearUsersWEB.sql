CREATE OR REPLACE FUNCTION llenar_usuarios_web()
RETURNS VOID AS $llenar_usuarios_web$
DECLARE
  reg RECORD;
  personas CURSOR FOR
  SELECT id_persona, persona_identificacion
  FROM public."Personas" WHERE persona_activa = true AND
  id_persona NOT IN (SELECT id_persona FROM public."UsersWeb"
  WHERE id_persona IS NOT NULL);
BEGIN
  OPEN personas;
  FETCH personas INTO reg;
  WHILE ( FOUND ) LOOP
    INSERT INTO public."UsersWeb" (
      id_persona, user_name, user_clave, is_superuser
    ) VALUES (
      reg.id_persona,
      reg.persona_identificacion,
      md5( md5('web') || reg.persona_identificacion || 'web'),
      'false'
    );
  FETCH personas INTO reg;
  END LOOP;
  RETURN;
END;
$llenar_usuarios_web$ LANGUAGE plpgsql;
