<?php
require_once 'src/modelo/fichas/seccion.php';
require_once 'src/modelo/fichas/preguntabd.php';

abstract class SeccionBD {

  private static $BASESELECT = '
  SELECT
  sf.id_seccion_ficha,
  seccion_ficha_nombre
  FROM
  public."SeccionesFicha" sf
  WHERE
  seccion_ficha_activa = true
  ';

  static function getPorIdTipoFicha($idFicha){
    $ct = getCon();

    $sql = self::$BASESELECT . " AND sf.id_tipo_ficha = $idFicha;";

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $secciones = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $s = SeccionFichaMD::getFromRow($r);

          $s->preguntas = PreguntaBD::getPorIdSeccion($s->id);

          array_push($secciones, $s);
        }
        return $secciones;
      } else {
        echo "No pudimos consultar las secciones de la ficha.";
        return [];
      }
    }
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

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $secciones = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $s = SeccionFichaMD::getFromRow($r);

          $s->preguntas = PreguntaBD::getPorIdSeccion($s->id);
          array_push($secciones, $s);
        }
        return $secciones;
      } else {
        echo "No pudimos consultar la seccion faltante";
        return [];
      }
    }
  }

}

 ?>
