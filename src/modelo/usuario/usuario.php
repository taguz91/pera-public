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


}
 ?>
