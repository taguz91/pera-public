<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';
require_once 'src/modelo/fichas/seccionbd.php';

class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  function inicio() {

    $fichas = FichaBD::getPorPersona(1);
    require_once cargarVista('fichas/ficha.php');
    /*
    global $user;
    if(strcasecmp("alumno", $user->tipo) == 0){
      $se = new SocioeconomicaCTR();
      $se->inicio();
    } else {
      $oc = new OcupacionalCTR();
      $oc->inicio();
    }*/
  }

  function ingresar($idTipoFicha) {
    $secciones = SeccionBD::getPorIdTipoFicha($idTipoFicha);
    var_dump($secciones);
  }

}
 ?>
