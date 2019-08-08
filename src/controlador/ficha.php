<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';

class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  public function inicio() {
    global $user;
    if(strcasecmp("alumno", $user->tipo) == 0){
      $se = new SocioeconomicaCTR();
      $se->inicio();
    } else {
      $oc = new OcupacionalCTR();
      $oc->inicio();
    }
  }

}
 ?>
