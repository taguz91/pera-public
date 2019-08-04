<?php
require_once 'src/modelo/fichas/pregunta.php';
require_once 'src/modelo/fichas/respuestabd.php';

abstract class PreguntaBD {

  static function getPorIdSeccion($idSeccion){
    $ct = getCon();

    $sql = '';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $preguntas = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $p = new PreguntaMD();

          $p->respuestas = RespuestaBD::getPorIdPregunta(1);

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
