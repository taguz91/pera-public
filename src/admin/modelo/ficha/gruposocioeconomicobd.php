<?php

abstract class GrupoSocioEconomicoBD {

  static function guardar($gs) {
    $sql = self::$INSERT;
    return executeSQL($sql, [
      'idTipoFicha' => $gs['id_tipo_ficha'],
      'grupoSocioEconomico' => $gs['grupo_socioeconomico'],
      'puntajeMinimo' => $gs['puntaje_minimo'],
      'puntajeMaximo' => $gs['puntaje_maximo']
    ]);
  }

  static function editar($gs) {
    $sql = self::$UPDATE;
    return executeSQL($sql, [
      'id' => $gs['id_grupo_socioeconomico'],
      'idTipoFicha' => $gs['id_tipo_ficha'],
      'grupoSocioEconomico' => $gs['grupo_socioeconomico'],
      'puntajeMinimo' => $gs['puntaje_minimo'],
      'puntajeMaximo' => $gs['puntaje_maximo']
    ]);
  }

  static function eliminar($id) {
    $sql = self::$DELETE;
    deleteById($sql, [
      'id' => $id
    ]);
  }

  static function getPorId($id){
    $sql = '
    SELECT
    id_grupo_socioeconomico,
    tF.id_tipo_ficha,
    gS.grupo_socioeconomico,
    gS.puntaje_minimo,
    gS.puntaje_maximo
    FROM public."GrupoSocioeconomico" gS,
    public."TipoFicha" tF
    WHERE gS.id_tipo_ficha=tF.id_tipo_ficha
    AND gS.grupo_socioeconomico_activo=true
    AND id_grupo_socioeconomico = :id;';

    return getOneFromSQL($sql, [
      'id' => $id
    ]);
  }

  static function getAll() {
    $sql = self::$BASEQUERY.' '.self::$ENDQUERY;
    return getArrayFromSQL($sql, []);
  }

  static function getPorTipoFicha($idTipoFicha){
    $sql = self::$BASEQUERY. "
    AND tf.id_tipo_ficha = :idTipoFicha ".self::$ENDQUERY;

    return getArrayFromSQL($sql, [
      'idTipoFicha' => $idTipoFicha
    ]);
  }

  static function buscar($aguja){
    $sql = self::$BASEQUERY."
    AND gS.grupo_socioeconomico ILIKE :aguja ".self::$ENDQUERY;

    return getArrayFromSQL($sql, [
      'aguja' => '%'.$aguja.'%'
    ]);
  }

  public static $BASEQUERY = '
  SELECT
  gs.id_grupo_socioeconomico,
  tf.tipo_ficha,
  gS.grupo_socioeconomico,
  gS.puntaje_minimo,
  gS.puntaje_maximo
  FROM
  public."GrupoSocioeconomico" gS,
  public."TipoFicha" tf
  WHERE gS.id_tipo_ficha = tf.id_tipo_ficha
  AND gS.grupo_socioeconomico_activo = true ';

  public static $ENDQUERY = '
  ORDER BY
  gS.grupo_socioeconomico DESC';

  public static $INSERT = '
  INSERT INTO public."GrupoSocioeconomico"(
     id_tipo_ficha, grupo_socioeconomico, puntaje_minimo, puntaje_maximo
  ) VALUES (
    :idTipoFicha, :grupoSocioEconomico, :puntajeMinimo, :puntajeMaximo
  );';

  public static $UPDATE = '
  UPDATE public."GrupoSocioeconomico"
  SET id_tipo_ficha = :idTipoFicha,
  grupo_socioeconomico = :grupoSocioEconomico,
  puntaje_minimo = :puntajeMinimo,
  puntaje_maximo = :puntajeMaximo
  WHERE id_grupo_socioeconomico = :id;';

  public static $DELETE = '
  UPDATE public."GrupoSocioeconomico"
  SET grupo_socioeconomico_activo = false
  WHERE id_grupo_socioeconomico = :id;';

}

?>
