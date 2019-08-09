<?php

class SocioeconomicaCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("alumno");
  }

  public function inicio() {
    $tipoFicha = 'Socioeconomica';

    $fichas = FichaBD::getPorPersona(1);
    require_once cargarVista('fichas/ficha.php');

  }

}
 ?>
