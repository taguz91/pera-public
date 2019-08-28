<?php

class RespuestaFSBD {

  static function actualizarRespuestaUnica($idAlmnRes, $idResFicha){
    $sql = '
    UPDATE public."AlumnoRespuestaFS"
    SET id_respuesta_ficha = :idResficha
    WHERE id_almn_respuesta_fs = :idAlmnRes';
    return executeSQL($sql, [
      'idResficha' => $idResFicha,
      'idAlmnRes' => $idAlmnRes
    ]);
  }
}


 ?>
