<?php
require_once 'src/modelo/fichas/pregunta.php';
require_once 'src/modelo/fichas/respuestabd.php';

abstract class PreguntaBD {

  static function getPorIdSeccion($idSeccion, $idPersonaFicha){
    $ct = getCon();

    $sql = '
    SELECT
    pf.id_pregunta_ficha,
    pf.pregunta_ficha,
    pf.pregunta_ficha_ayuda,
    (SELECT id_respuesta_ficha
    FROM public."AlumnoRespuestaFS"
    WHERE id_pregunta_ficha = pf.id_pregunta_ficha
    AND id_persona_ficha = '.$idPersonaFicha.') AS respuesta,
    (SELECT id_almn_respuesta_fs
    FROM public."AlumnoRespuestaFS"
    WHERE id_pregunta_ficha = pf.id_pregunta_ficha
    AND id_persona_ficha = '.$idPersonaFicha.') AS actualizar
    FROM
    public."PreguntasFicha" pf
    WHERE
    pf.id_seccion_ficha = '.$idSeccion.';
    ';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $preguntas = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $p = PreguntaFichaMD::getFromRow($r);
          $p->r = [
            'respuesta' => $r['respuesta'],
            'actualizar' => $r['actualizar']
          ];
          $p->respuestas = RespuestaBD::getPorIdPregunta($p->id);

          array_push($preguntas, $p);
        }
        return $preguntas;
      } else {
        return [];
      }
    }
  }

}

 ?>
