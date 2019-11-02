<?php
require_once 'src/modelo/persona/personabd.php';

class PersonaCTR extends CTR implements DCTR {
  function __construct() {
    parent::__construct('admin');
  }

  public function inicio($mensaje = null) {
    $personas = PersonaBD::getAll();
    require cargarVistaAdmin('persona/index.php');
  }


}

 ?>
