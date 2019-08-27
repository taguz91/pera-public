<?php

class CarreraBD {

  static private $BASEQUERY = '
  SELECT
  id_carrera,
  carrera_nombre,
  carrera_codigo
  FROM public."Carreras"
  WHERE
  ';
  static private $ENDQUERY = '
  carrera_activo = true
  ORDER BY carrera_codigo;
  ';

  function cargarTodos() {
    $query = self::$BASEQUERY . ' ' . self::$ENDQUERY;
    return getArrayFromSQL($query, []);
  }

  function buscar($id_carrera) {
    $query = self::$BASEQUERY . "
    id_carrera = :idCarrera AND
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'idCarrera' => $id_carrera
    ]);
  }

  function buscarCarrera($aguja) {
    $query = self::$BASEQUERY . "
    (carrera_nombre ILIKE :aguja1 OR
      carrera_codigo ILIKE :aguja2 ) AND
    " . self::$ENDQUERY;
    return getArrayFromSQL($query, [
      'aguja1' => '%'.$aguja.'%',
      'aguja2' => '%'.$aguja.'%'
    ]);
  }


}

?>
