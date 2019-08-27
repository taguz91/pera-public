SELECT DISTINCT
p.id_persona, p.persona_correo
FROM (
  (
    ("Cursos" c JOIN "AlumnoCurso" a USING(id_curso))
    JOIN "Alumnos" al USING(id_alumno)
  )
    JOIN "Personas" p USING(id_persona)
  ) WHERE al.id_alumno NOT IN (
      SELECT id_alumno FROM "Alumnos"
      WHERE id_persona IN (
        SELECT id_persona
        FROM public."PersonaFicha"
        WHERE id_permiso_ingreso_ficha = 2)
      ) AND c.curso_ciclo = 1
      AND c.id_prd_lectivo = (
        SELECT per.id_prd_lectivo
        FROM public."PersonaFicha" p JOIN     public."PermisoIngresoFichas" per USING(id_permiso_ingreso_ficha)
WHERE p.id_permiso_ingreso_ficha = 2);


SELECT p.id_persona, p.persona_correo
FROM public."Personas" p
WHERE id_persona IN (
  SELECT id_persona
  FROM public."Alumnos" a
  WHERE id_alumno IN (
    SELECT id_alumno
    FROM public."AlumnoCurso" ac
    WHERE id_curso = (
      SELECT id_curso
      FROM public."Cursos" c
      WHERE c.curso_ciclo = 2 AND
      c.id_prd_lectivo = (
        SELECT id_prd_lectivo
        FROM public."PermisoIngresoFichas"
        WHERE id_permiso_ingreso_ficha = 4
      )
    )
  )
)
