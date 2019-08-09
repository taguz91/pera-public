<?php
require_once 'src/modelo/fichas/pregunta.php';
require_once 'src/modelo/fichas/respuestabd.php';

abstract class PreguntaBD {

  static function getPorIdSeccion($idSeccion){
    $ct = getCon();

    $sql = '
    SELECT
    pf.id_pregunta_ficha,
    pf.pregunta_ficha,
    pf.pregunta_ficha_ayuda
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

          $p->respuestas = RespuestaBD::getPorIdPregunta($p->id);

          array_push($preguntas, $p);
        }
        return $preguntas;
      } else {
        echo "No pudimos consultar las preguntas de las fichas";
        return [];
      }
    }
  }

}

 ?>
