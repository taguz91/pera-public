<?php

class PersonaFichaMD {

  public $id;
  public $fechaIngreso;
  public $fechaModificacion;
  //Foraneas
  public $idPermisoIngreso;
  public $idPersona;
  //Objetos
  public $permisoIngreso;
  public $persona;


  public static function getFromRow($r){
    $pf = new PersonaFichaMD();
    $pf->id = isset($r['id_persona_ficha']) ? $r['id_persona_ficha'] : null;
    $pf->fechaIngreso = isset($r['persona_ficha_fecha_ingreso']) ? $r['persona_ficha_fecha_ingreso'] : null;
    $pf->fechaModificacion = isset($r['persona_ficha_fecha_modificacion']) ? $r['persona_ficha_fecha_modificacion'] : null;

    if(isset($r['id_permiso_ingreso_ficha'])){
      $pf->idPermisoIngreso = $r['id_permiso_ingreso_ficha'];
      $pf->permisoIngreso = PermisoIngresoMD::getFromRow($r);
    }

    if(isset($r['id_persona'])){
      $pf->idPersona = $r['id_persona'];
      $pf->persona = PersonaMD::getFromRow($r);
    }
    
    return $pf;
  }

}

 ?>
