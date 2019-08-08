<?php

require_once 'src/modelo/persona/personaficha.php';
require_once 'src/modelo/fichas/tipo.php';
require_once 'src/modelo/fichas/permisoingreso.php';

class FichaMD {

  public $idPeriodo;
  public $periodoLectivo;
  //Foraneas
  public $idTipoFicha;
  //public $idPermisoingreso;
  public $idPersonaFicha;
  //Objetos
  public $tipoFicha;
  //public $permisoIngreso;
  public $personaFicha;

  public static function getFromRow($r){
    $f = new FichaMD();
    $f->idPeriodo = isset($r['id_prd_lectivo']) ? $r['id_prd_lectivo'] : null;
    $f->periodoLectivo = isset($r['prd_lectivo_nombre']) ? $r['prd_lectivo_nombre'] : null;

    if(isset($r['id_tipo_ficha'])){
      $f->tipoFicha = $r['id_tipo_ficha'];
      $f->tipoFicha = TipoFichaMD::getFromRow($r);
    }

    /*if(isset($r['id_permiso_ingreso_ficha'])){
      $f->idPermisoIngreso = $r['id_permiso_ingreso_ficha'];
      $f->permisoIngreso = PermisoIngresoMD::getFromRow($r);
    }*/

    if(isset($r['id_persona_ficha'])){
      $f->idPersonaFicha = $r['id_persona_ficha'];
      $f->personaficha = PersonaFichaMD::getFromRow($r);
    }

    return $f;
  }

}

 ?>
