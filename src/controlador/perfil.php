<?php
require_once 'src/modelo/persona/personabd.php';

class PerfilCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("todos");
  }

  public function inicio() {
    global $user;
    require_once cargarVista('static/perfil.php');
  }

  function foto() {
    global $user;
    PersonaBD::cargarFoto($user->idPersona);
  }

}
 ?>
