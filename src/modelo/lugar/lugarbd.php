<?php


class LugarBD {

  static function getAllPaises() {
    $sql = self::$BASEQUERY . ' WHERE lugar_nivel = 1;';
    return getResArray($sql);
  }

  static function getAllPorReferencia($id) {
    $sql = self::$BASEQUERY . ' WHERE id_lugar_referencia = ' . $id . ';';
    return getResArray($sql);
  }

  static $BASEQUERY = '
  SELECT id_lugar,
  lugar_nombre
  FROM public."Lugares" ';

}

 ?>
