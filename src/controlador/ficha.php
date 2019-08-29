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
    global $U;
    $fichas = FichaBD::getPorPersona($U->idPersona);

    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar($idPersonaFicha) {
    $secciones = SeccionBD::getPorIdPersonaFicha($idPersonaFicha);
    require_once cargarVista('fichas/formulario.php');
  }

  function verficha($idPersonaFicha){
    $secciones = SeccionBD::getPorIdPersonaFicha($idPersonaFicha);
    require_once cargarVista('fichas/verficha.php');
  }

}
 ?>
