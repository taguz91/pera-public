<?php

abstract class PersonaBD {

  static function getFotoPorId($idPersona) {
    $ct = getCon();
    $sql =  '
    SELECT encode(persona_foto, \'base64\') as foto FROM public."Personas"
    WHERE id_persona = '.$idPersona.';';

    if($ct != null){
      $res = $ct->query($sql);
      if($res != null){

        if($res->rowCount()) {
          $foto = null;
          while ($r = $res->fetch(PDO::FETCH_ASSOC)) {
            $foto = $r['foto'];
          }
          header('Content-type: image/png');
          echo base64_decode($foto);
        }
      }
    }
  }

  static function getFotoPorIden($identificacion) {
    $sql =  '
    SELECT encode(persona_foto, \'base64\') as foto FROM public."Personas"
    WHERE persona_identificacion = :iden';
    $res = getOneFromSQL($sql, [
      'iden' => $identificacion
    ]);
    return $res['foto'];
  }

  static function actualizarDato($idPersona, $valor, $columna){
    $sql = '
    UPDATE public."Personas"
    SET '.$columna.' = :valor
    WHERE id_persona = :id;';
    return executeSQL($sql, [
      'valor' => $valor,
      ':id' => $idPersona
    ]);
  }

  static function getPorId($idPersona){
    $sql = self::$SELECTALL . ' WHERE id_persona = :id';
    return getOneFromSQL($sql, [
      'id' => $idPersona
    ]);
  }

  static private $SELECTALL = '
  SELECT
  id_lugar_natal,
  id_lugar_residencia,
  persona_identificacion,
  persona_primer_apellido,
  persona_segundo_apellido,
  persona_primer_nombre,
  persona_segundo_nombre,
  persona_genero,
  persona_sexo,
  persona_estado_civil,
  persona_etnia,
  persona_idioma_raiz,
  persona_tipo_sangre,
  persona_telefono,
  persona_celular,
  persona_correo,
  persona_fecha_registro,
  persona_discapacidad,
  persona_tipo_discapacidad,
  persona_porcenta_discapacidad,
  persona_carnet_conadis,
  persona_calle_principal,
  persona_numero_casa,
  persona_calle_secundaria,
  persona_referencia,
  persona_sector,
  persona_idioma,
  persona_tipo_residencia,
  persona_fecha_nacimiento,
  persona_categoria_migratoria
  FROM public."Personas" ';

}

 ?>
