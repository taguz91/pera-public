<?php

class OcupacionalCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("docente");
  }

  public function inicio() {
    $tipoFicha = 'Ocupacional';
    require_once cargarVista('fichas/ficha.php');

  }

}
 ?>
