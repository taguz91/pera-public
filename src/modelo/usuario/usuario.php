<?php
class UsuarioMD {

  public $id;
  public $username;
  public $tipo;
  public $idPersona;
  public $primerNombre;
  public $segundoNombre;
  public $primerApellido;
  public $segundoApellido;
  public $correo;
  public $celular;

  function getNombre(){
    return $this->primerNombre . ' ' . $this->segundoNombre;
  }

  function getApellido(){
    return $this->primerApellido . ' ' . $this->segundoApellido;
  }

  function getNombreCorto(){
    return $this->primerNombre . ' ' . $this->primerApellido;
  }

  static function getFromRow($r){
    $u = new UsuarioMD();

    $u->id = isset($r['id_user_web']) ? $r['id_user_web'] : null;
    $u->username = isset($r['user_name']) ? $r['user_name'] : null;
    $u->idPersona = isset($r['id_persona']) ? $r['id_persona'] : null;
    $u->primerNombre = isset($r['persona_primer_nombre']) ? $r['persona_primer_nombre'] : null;
    $u->segundoNombre = isset($r['persona_segundo_nombre']) ? $r['persona_segundo_nombre'] : null;
    $u->primerApellido = isset($r['persona_primer_apellido']) ? $r['persona_primer_apellido'] : null;
    $u->segundoApellido = isset($r['persona_segundo_apellido']) ? $r['persona_segundo_apellido'] : null;
    $u->correo = isset($r['persona_correo']) ? $r['persona_correo'] : null;
    $u->celular = isset($r['persona_celular']) ? $r['persona_celular'] : null;

    $u->tipo = 'todos';
    return $u;
  }


}
 ?>
