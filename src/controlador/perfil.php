<?php
require_once 'src/modelo/persona/personabd.php';
require_once 'src/modelo/alumno/alumnobd.php';

class PerfilCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("todos");
  }

  public function inicio() {
    global $U;
    require_once cargarVista('persona/perfil.php');
  }

  function guardar() {
    include cargarVista('persona/form.php');
  }

  function editar() {
    global $U;
    $persona = PersonaBD::getPorId($U->idPersona);
    $alumno = AlumnoBD::getPorId($U->idPersona);
    PersonaBD::actualizarFecha($U->idPersona);
    include cargarVista('persona/form.php');
  }

  function foto() {
    global $U;
    PersonaBD::getFotoPorId($U->idPersona);
  }

}
 ?>
