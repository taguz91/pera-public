<?php
class PeriodoBD {

  static private $BASEQUERY = '
  SELECT
  id_prd_lectivo,
  prd_lectivo_nombre
  FROM public."PeriodoLectivo"
  WHERE

  ';
  static private $ENDQUERY = '
  prd_lectivo_activo = true
  ORDER BY
  prd_lectivo_nombre,
  prd_lectivo_fecha_fin DESC;
  ';

  function cargarTodos() {
    $sql = self::$BASEQUERY . ' ' . self::$ENDQUERY;
    return getArrayFromSQL($sql , []);
  }

  function buscar($idPeriodo) {
    $sql = self::$BASEQUERY . "
      id_prd_lectivo = :idPeriodo AND
    " . self::$ENDQUERY;
    return getArrayFromSQL($sql , [
      'idPeriodo' => $idPeriodo
    ]);
  }

  function buscarPeriodo($aguja) {
    $sql = self::$BASEQUERY . "
      prd_lectivo_nombre ILIKE '%:aguja%' AND
    " . self::$ENDQUERY;
    return getArrayFromSQL($sql , [
      'aguja' => $aguja
    ]);
  }

  function buscarPorCarrera($idCarrera) {
    $sql = self::$BASEQUERY . "
      id_carrera = :idCarrera AND
    " . self::$ENDQUERY;
    return getArrayFromSQL($sql , [
      'idCarrera' => $idCarrera
    ]);
  }

}

?>
