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
  }

  function tipo($idTipoFicha) {
    $secciones = SeccionBD::getPorIdTipoFicha($idTipoFicha);
    require_once cargarVista('fichas/formulario.php');
  }

  function ingresar($idPersonaFicha) {
    $secciones = SeccionBD::getPorIdPersonaFicha($idPersonaFicha);
    //$titulo = 'Formulario de ficha';
    require_once cargarVista('fichas/formulario.php');
  }

  function seccion($idPersonaFicha) {
    $secciones = SeccionBD::getSeccionFaltante($idPersonaFicha);
    require_once cargarVista('fichas/formulario.php');
  }

  function verficha($idPersonaFicha){
    $secciones = SeccionBD::getPorIdPersonaFicha($idPersonaFicha);
    require_once cargarVista('fichas/verficha.php');
  }

}
 ?>
