<?php

abstract class RespuestaBD {

  static function getPorIdPregunta($idPregunta){
    $sql = '
    SELECT
    rf.id_respuesta_ficha,
    rf.respuesta_ficha
    FROM
    public."RespuestaFicha" rf
    WHERE
    rf.id_pregunta_ficha = :idPregunta;';
    return getArrayFromSQL($sql, [
      'idPregunta' => $idPregunta
    ]);
  }

}

 ?>
