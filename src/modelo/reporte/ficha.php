<?php

class ReporteFicha {

  static function getReporteFS($idPersona, $idPersonaFicha){
    $sql = '
    SELECT array_to_json(
      array_agg(a.*)
    ) AS alumnos FROM (
      SELECT
      per.id_persona,
      consultar_pais(id_lugar_natal) AS pais_nacimiento,
      consultar_provincia(id_lugar_natal) AS provincia_nacimiento,
      consultar_ciudad(id_lugar_natal) AS ciudad_nacimiento,
      consultar_parroquia(id_lugar_natal) AS parroquia_nacimiento,
      consultar_pais(id_lugar_residencia) AS pais_residencia,
      consultar_provincia(id_lugar_residencia) AS
      provincia_residencia,
      consultar_ciudad(id_lugar_residencia) AS
      ciudad_residencia,
      consultar_parroquia(id_lugar_residencia) AS
      parroquia_residencia,
      persona_identificacion,
      persona_primer_apellido,
      persona_segundo_apellido,
      persona_primer_nombre,
      persona_segundo_nombre,
      persona_genero,
      persona_sexo,
      persona_estado_civil,
      persona_etnia,
      persona_idioma_raiz,
      persona_tipo_sangre,
      persona_telefono,
      persona_celular,
      persona_correo,
      persona_fecha_registro,
      CASE 
        WHEN persona_discapacidad THEN
          \'Si\'
        ELSE
          \'No\'
      END AS persona_discapacidad,
      persona_tipo_discapacidad,
      persona_porcenta_discapacidad,
      persona_carnet_conadis,
      persona_calle_principal,
      persona_numero_casa,
      persona_calle_secundaria,
      persona_referencia,
      persona_sector,
      persona_idioma,
      persona_tipo_residencia,
      persona_fecha_nacimiento,
      persona_activa,
      persona_categoria_migratoria,
      alumno_nombre_contacto_emergencia,
      alumno_numero_contacto,
      alumno_parentesco_contacto,

      (
        SELECT array_to_json(
          array_agg(gs.*)
        ) AS grupo_socioeconomico FROM (
          SELECT grupo_socioeconomico
          FROM public."GrupoSocioeconomico"
          WHERE puntaje_minimo >= (
            SELECT SUM(respuesta_almn_puntaje)
            FROM public."AlumnoRespuestaFS"
            WHERE id_persona_ficha = :idPersonaFicha3
          )
          ORDER BY puntaje_maximo
          LIMIT 1
        ) AS gs
      ),

      (
        SELECT array_to_json(
          array_agg(c.*)
        ) AS carrera_actual FROM (
          SELECT
          carrera_nombre,
          prd_lectivo_nombre,
          curso_ciclo
          FROM public."AlumnoCurso" ac
          JOIN public."Cursos" c ON
          c.id_curso = ac.id_curso
          JOIN public."PeriodoLectivo" pl ON
          pl.id_prd_lectivo = c.id_prd_lectivo
          JOIN public."Carreras" cr ON
          cr.id_carrera = pl.id_carrera
          WHERE id_alumno = alu.id_alumno AND
          almn_curso_activo = true
          ORDER BY curso_ciclo DESC
          LIMIT 1
        ) AS c
      ),

      (
        SELECT array_to_json (
          array_agg(f.*)
        ) AS ficha FROM (
          SELECT

          tipo_ficha,
          tipo_ficha_descripcion
          FROM public."TipoFicha" tf
          JOIN public."PermisoIngresoFichas" pif ON
          pif.id_tipo_ficha = tf.id_tipo_ficha
          JOIN public."PersonaFicha" prf ON
          pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
          WHERE prf.id_persona_ficha = :idPersonaFicha1
        ) AS f
      ), (
        SELECT array_to_json (
          array_agg(s.*)
        ) AS secciones FROM (
          SELECT
          seccion_ficha_nombre, (
            SELECT array_to_json(
              array_agg(p.*)
            ) AS preguntas FROM (
              SELECT
              pregunta_ficha,
              pregunta_ficha_tipo, (
                SELECT array_to_json(
                  array_agg(rl.*)
                ) respuesta FROM (
                  SELECT
                  respuesta_ficha
                  FROM
                  public."AlumnoRespuestaFS" arfs
                  JOIN public."RespuestaFicha" rfs ON
                  arfs.id_respuesta_ficha = rfs.id_respuesta_ficha
                  WHERE arfs.id_pregunta_ficha = pf.id_pregunta_ficha AND
                  arfs.id_persona_ficha = prf.id_persona_ficha
                ) AS rl
              ) , (
                SELECT array_to_json(
                  array_agg(rl.*)
                ) AS respuesta_libre FROM (
                  SELECT
                  alumno_fs_libre
                  FROM public."AlumnoRespuestaLibreFS" arlfs
                  WHERE
                  arlfs.id_pregunta_ficha = pf.id_pregunta_ficha  AND
                  arlfs.id_persona_ficha = prf.id_persona_ficha
                  ORDER BY alumno_fs_fecha_ingreso
                ) AS rl
              )
              FROM public."PreguntasFicha" pf
              WHERE id_seccion_ficha = sf.id_seccion_ficha AND
              pregunta_ficha_activa = true
              ORDER BY pregunta_ficha_posicion
            ) AS p
          )
          FROM public."SeccionesFicha" sf
          JOIN public."PermisoIngresoFichas" pif ON
          pif.id_tipo_ficha = sf.id_tipo_ficha
          JOIN public."PersonaFicha" prf ON
          pif.id_permiso_ingreso_ficha = prf.id_permiso_ingreso_ficha
          WHERE seccion_ficha_activa = true AND
          prf.id_persona_ficha = :idPersonaFicha2
          ORDER BY seccion_ficha_posicion
        ) as s
      )
      FROM public."Personas" per
      JOIN public."Alumnos" alu ON
      alu.id_persona =  per.id_persona
      WHERE persona_activa = true AND
      per.id_persona = :idPersona
    ) AS a;
  ';
    return getOneFromSQL($sql, [
      'idPersona' => $idPersona,
      'idPersonaFicha1' => $idPersonaFicha,
      'idPersonaFicha2' => $idPersonaFicha,
      'idPersonaFicha3' => $idPersonaFicha
    ]);
  }


}
