<?php
require_once 'src/modelo/persona/personabd.php';

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

  function editar($idPersona) {
    include cargarVista('persona/form.php');
  }

  function foto() {
    global $U;
    PersonaBD::cargarFoto($U->idPersona);
  }

}
 ?>
