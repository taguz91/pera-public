<?php

class SocioeconomicaCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("alumno");
  }

  public function inicio() {
    $tipoFicha = 'Socioeconomica';
    //require_once 'src/vista/fichas/ficha.php';
    require_once cargarVista('fichas/ficha.php');
  }

}
 ?>
