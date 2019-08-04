<?php

class SocioeconomicaCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct("alumno");
  }

  public function inicio() {
    echo "Estamos en la ficha socioenomica";
  }

}
 ?>
