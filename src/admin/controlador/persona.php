<?php
require_once 'src/modelo/persona/personabd.php';

class PersonaCTR extends CTR implements DCTR {
  function __construct() {
    parent::__construct('admin');
  }

  function inicio($mensaje = null) {
    $personas = PersonaBD::getAll();
    require cargarVistaAdmin('persona/index.php');
  }

  function alumno() {
    $personas = PersonaBD::getAlumnos();
    require cargarVistaAdmin('persona/alumno.php');
  }

  function docente() {
    $personas = PersonaBD::getDocentes();
    require cargarVistaAdmin('persona/docente.php');
  }


}

 ?>
