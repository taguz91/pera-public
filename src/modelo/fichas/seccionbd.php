<?php
require_once 'src/modelo/fichas/preguntabd.php';

abstract class SeccionBD {

  private static $BASESELECT = '
  SELECT
  sf.id_seccion_ficha,
  seccion_ficha_nombre
  FROM
  public."SeccionesFicha" sf
  WHERE
  seccion_ficha_activa = true';

  static function getPorIdPersonaFicha($idPersonaFicha){
    $sql = self::$BASESELECT . ' AND sf.id_tipo_ficha = (
      SELECT id_tipo_ficha
      FROM public."PermisoIngresoFichas" pif,
      public."PersonaFicha" pf
      WHERE
      id_persona_ficha = '.$idPersonaFicha.' AND
      pif.id_permiso_ingreso_ficha = pf.id_permiso_ingreso_ficha
    );';

    $secciones = getArrayFromSQL($sql, []);
    $newsecciones = [];
    if(!isset($secciones['error'])){
      foreach ($secciones as $s) {
        $preguntas = PreguntaBD::getPorIdSeccionIdPersonaFicha($s['id_seccion_ficha'], $idPersonaFicha);
        if(!isset($preguntas['error'])){
          $s += ['preguntas' => $preguntas];
          array_push($newsecciones, $s);
        }
      }
    }

    return $newsecciones;
  }


  static function getSeccionFaltante($idPersonaFicha){
    $ct = getCon();

    $sql = self::$BASESELECT . ' AND id_seccion_ficha = (
      SELECT
      MIN(sf.id_seccion_ficha)
      FROM
      public."SeccionesFicha" sf
      WHERE
      sf.id_seccion_ficha NOT IN (
        SELECT DISTINCT id_seccion_ficha
        FROM public."AlumnoRespuestaFS" ar,
        public."RespuestaFicha" rf,
        public."PreguntasFicha" pf
        WHERE
        rf.id_respuesta_ficha = ar.id_respuesta_ficha AND
        pf.id_pregunta_ficha = rf.id_pregunta_ficha AND
        ar.id_persona_ficha = '.$idPersonaFicha.'
      ) AND sf.id_seccion_ficha NOT IN (
        SELECT DISTINCT id_seccion_ficha
        FROM public."AlumnoRespuestaLibreFS" arl,
        public."RespuestaFicha" rf
        WHERE
        rf.id_pregunta_ficha = arl.id_pregunta_ficha AND
        arl.id_persona_ficha = '.$idPersonaFicha.'
      )
    );';

    return self::getSecciones($sql, $idPersonaFicha);
  }

}

 ?>
