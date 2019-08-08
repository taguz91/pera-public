<?php

class PermisoIngresoMD {

  public $id;
  public $fechaInicio;
  public $fechaFin;
  //Foraneas
  public $idTipoFicha;
  //Objetos
  public $tipoFicha;


  static function getFromRow($r){
    $pi = new PermisoIngresoMD();
    $pi->id = isset($r['id_permiso_ingreso_ficha']) ? $r['id_permiso_ingreso_ficha'] : null;
    $pi->fechaInicio = isset($r['permiso_ingreso_fecha_inicio']) ? $r['permiso_ingreso_fecha_inicio'] : null;
    $pi->fechaFin = isset($r['permiso_ingreso_fecha_fin']) ? $r['permiso_ingreso_fecha_fin'] : null;

    if(isset($r['id_tipo_ficha'])){
      $pi->idTipoFicha = $r['id_tipo_ficha'];
      $pi->tipoFicha = TipoFichaMD::getFromRow($r);
    }

    return $pi;
  }

}
 ?>
