GRANT ALL ON public."TipoFicha" TO fichasphpubi;
GRANT ALL ON public."GrupoSocioeconomico" TO fichasphpubi;
GRANT ALL ON public."SeccionesFicha" TO fichasphpubi;
GRANT ALL ON public."PreguntasFicha" TO fichasphpubi;
GRANT ALL ON public."RespuestaFicha" TO fichasphpubi;
GRANT ALL ON public."PermisoIngresoFichas" TO fichasphpubi;
GRANT ALL ON public."PersonaFicha" TO fichasphpubi;
GRANT ALL ON public."DocenteRespuestaFO" TO fichasphpubi;
GRANT ALL ON public."AlumnoRespuestaFS" TO fichasphpubi;
GRANT ALL ON public."AlumnoRespuestaLibreFS" TO fichasphpubi;

--Permiso con todas las secuencias
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO fichasphpubi;
