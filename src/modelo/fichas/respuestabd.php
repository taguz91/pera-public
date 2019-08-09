<?php
require_once 'src/modelo/fichas/respuesta.php';

abstract class RespuestaBD {

  static function getPorIdPregunta($idPregunta){
    $ct = getCon();

    $sql = '
    SELECT
    rf.id_respuesta_ficha,
    rf.respuesta_ficha
    FROM
    public."RespuestaFicha" rf
    WHERE
    rf.id_pregunta_ficha = '.$idPregunta.';
    ';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $respuestas = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $rt = RespuestaFichaMD::getFromRow($r);

          array_push($respuestas, $rt);
        }
        return $respuestas;
      } else {
        echo "No pudimos consultar las respuesta de la ficha";
        return [];
      }
    }
  }

}

 ?>
