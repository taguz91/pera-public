<?php

abstract class TipoFichaBD{

  static function guardar($tf) {
    return executeSQL(self::$INSERT, [
      'tipoFicha' => $tf['tipo_ficha'],
      'descripcion' => $tf['tipo_ficha_descripcion']
    ]);
  }

  static function editar($tf) {
    return executeSQL(self::$UPDATE, [
      'id' => $tf['id_tipo_ficha'],
      'tipoFicha' => $tf['tipo_ficha'],
      'descripcion' => $tf['tipo_ficha_descripcion']
    ]);
  }

  static function eliminar($id) {
    deleteById(self::$DELETE, $id);
  }

  public static function getParaCombo(){
    $sql = '
    SELECT
    id_tipo_ficha,
    tipo_ficha
    FROM
    public."TipoFicha"
    WHERE
    tipo_ficha_activo = true
    '.self::$ENDQUERY;

    return getArrayFromSQL($sql, []);
  }

  public static function getAll(){
    $sql = self::$BASEQUERY.'
    '.self::$ENDQUERY;

    return getArrayFromSQL($sql, []);
  }

  static function getPorId($idTipoFicha) {
    $sql = self::$BASEQUERY
    . ' AND id_tipo_ficha = :id ';

    return getOneFromSQL($sql, [
      'id' => $idTipoFicha
    ]);
  }


  private static $BASEQUERY = '
  SELECT
  id_tipo_ficha,
  tipo_ficha,
  tipo_ficha_descripcion
  FROM
  public."TipoFicha"
  WHERE
  tipo_ficha_activo = true
  ';

  private static $ENDQUERY = '
  ORDER BY
  tipo_ficha;';

  public static $INSERT = '
  INSERT INTO public."TipoFicha"(
  tipo_ficha, tipo_ficha_descripcion)
  VALUES(:tipoFicha, :descripcion)';

  public static $UPDATE = '
  UPDATE public."TipoFicha"
  SET tipo_ficha = :tipoFicha,
  tipo_ficha_descripcion = :descripcion
  WHERE id_tipo_ficha = :id;';

  public static $DELETE = '
  UPDATE public."TipoFicha"
  SET tipo_ficha_activo = false
  WHERE id_tipo_ficha = :id;';
}
?>
