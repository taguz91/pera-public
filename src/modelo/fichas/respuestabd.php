<?php
require_once 'src/modelo/fichas/respuesta.php';

abstract class RespuestaBD {

  static function getPorIdPregunta($idPregunta){
    $ct = getCon();

    $sql = '';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $respuestas = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $rt = new RespuestaMD();

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
