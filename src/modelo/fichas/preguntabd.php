<?php
require_once 'src/modelo/fichas/respuestabd.php';

abstract class PreguntaBD {

  static function getPorIdSeccionIdPersonaFicha($idSeccion, $idPersonaFicha){
    $sql = '
    SELECT
    pf.id_pregunta_ficha,
    pf.pregunta_ficha,
    pf.pregunta_ficha_ayuda,
    (SELECT id_respuesta_ficha
    FROM public."AlumnoRespuestaFS"
    WHERE id_pregunta_ficha = pf.id_pregunta_ficha
    AND id_persona_ficha = :idPersonaFicha1 ) AS respuesta,
    (SELECT id_almn_respuesta_fs
    FROM public."AlumnoRespuestaFS"
    WHERE id_pregunta_ficha = pf.id_pregunta_ficha
    AND id_persona_ficha = :idPersonaFicha2 ) AS actualizar
    FROM
    public."PreguntasFicha" pf
    WHERE
    pf.id_seccion_ficha = '.$idSeccion.';
    ';

    $preguntas = getArrayFromSQL($sql, [
      'idPersonaFicha1' => $idPersonaFicha,
      'idPersonaFicha2' => $idPersonaFicha
    ]);
    $newpreguntas = [];

    if(!isset($preguntas['error'])){
      foreach ($preguntas as $p) {
        $res = RespuestaBD::getPorIdPregunta($p['id_pregunta_ficha']);
        if(!isset($res['error'])){
          $p['respuestas'] = $res;
          array_push($newpreguntas, $p);
        }
      }
    }

    return $newpreguntas;
  }

}

 ?>
