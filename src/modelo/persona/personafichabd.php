<?php

abstract class PersonaFichaBD {

  static function getPorLogin($idPersona, $pass){
    $sql = '
    SELECT id_persona_ficha
    FROM public."PersonaFicha"
    WHERE id_persona = :idPer AND
    persona_ficha_clave = set_byte( MD5(:clave) :: bytea, 4, 64);';
    $res = getOneFromSQL($sql, [
      'idPer' => $idPersona,
      'clave' => $pass
    ]);
    if($res != null){
      return $res['id_persona_ficha'];
    }
  }

  static function finalizar($idPersonaFicha) {
    $sql = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_finalizada = true
    WHERE id_persona_ficha = :id;';
    return executeSQL($sql, [
      'id' => $idPersonaFicha
    ]);
  }

  static function actualizarFecha($idPersonaFicha) {
    $sql = '
    UPDATE public."PersonaFicha"
    SET persona_ficha_fecha_ingreso = now()
    WHERE id_persona_ficha = :id;';
    return executeSQL($sql, [
      'id' => $idPersonaFicha
    ]);
  }

  static function getFinalizados() {
    $sql = '';
    return getArrayFromSQL($sql , []);
  }

}

 ?>
