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

  static function ingresarRespuestaLibre($idPersonaFicha, $idPreguntaFicha, $respuesta){
    $sql = '
    INSERT INTO public."AlumnoRespuestaLibreFS" (
      id_persona_ficha,
      id_pregunta_ficha,
      alumno_fs_libre
    ) VALUES (
      :idPersona,
      :idPregunta,
      :respuesta
    );
    ';
    return executeSQL($sql, [
      'idPersona' => $idPersonaFicha,
      'idPregunta' => $idPreguntaFicha,
      'respuesta' => $respuesta
    ]);
  }

  static function actualizarRespuestaLibre($idRespuestaLibre, $respuesta){
    $sql = '
    UPDATE public."AlumnoRespuestaLibreFS"
    SET alumno_fs_libre = :respuesta
    WHERE id_almn_respuesta_libre_fs = :idRespuestaLibre;';
    return executeSQLO($sql, [
      'respuesta' => $respuesta,
      'idRespuestaLibre' => $idRespuestaLibre
    ]);
  }
}


 ?>
