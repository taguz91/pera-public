<?php

class PersonaMD {

  public $id;
  public $primerNombre;
  public $segundoNombre;
  public $primerApellido;
  public $segundoApellido;
  public $correo;
  public $celular;


  function static getFromRow($r){
    $p = new PersonaMD();

    $p->id = isset($r['id_persona']) ? $r['id_persona'] : null;
    $p->primerNombre = isset($r['persona_primer_nombre']) ? $r['persona_primer_nombre'] : null;
    $p->segundoNombre = isset($r['persona_segundo_nombre']) ? $r['persona_segundo_nombre'] : null;
    $p->primerApellido = isset($r['persona_primer_apellido']) ? $r['persona_primer_apellido'] : null;
    $p->segundoApellido = isset($r['persona_segundo_apellido']) ? $r['persona_segundo_apellido'] : null;
    $p->correo = isset($r['persona_correo']) ? $r['persona_correo'] : null;
    $p->celular = isset($r['persona_celular']) ? $r['persona_celular'] : null;

    return $p;
  }

}

 ?>
