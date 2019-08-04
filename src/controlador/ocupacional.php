<?php

class OcupacionalCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("docente");
  }

  public function inicio() {
    echo "Estamos en la ficha ocupacional";
  }

}
 ?>
