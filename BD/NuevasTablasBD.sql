CREATE TABLE "UsersWeb" (
  id_user_web serial NOT NULL,
  id_persona integer NOT NULL,
  user_tipo character varying(50) NOT NULL,
  user_name character varying(50) NOT NULL UNIQUE,
  user_clave character varying(255) NOT NULL,
  user_activo boolean NOT NULL DEFAULT 'true',
  CONSTRAINT user_web_pk PRIMARY KEY ("id_user_web")
) WITH (OIDS = FALSE);

--Foraneas
ALTER TABLE "UsersWeb" ADD CONSTRAINT
"userweb_persona"
FOREIGN KEY ("id_persona") REFERENCES
"Personas"("id_persona")
ON DELETE CASCADE ON UPDATE CASCADE;
