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

}

 ?>
