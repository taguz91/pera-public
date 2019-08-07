<?php

class PerfilCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("todos");
  }

  public function inicio() {
    require_once cargarVista('static/perfil.php');
  }

}
 ?>
