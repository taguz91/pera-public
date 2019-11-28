<?php
require_once "src/admin/modelo/ficha/personafichabd.php";
require_once "src/admin/modelo/ficha/permisoingresobd.php";
require_once "src/modelo/periodo/periodobd.php";
require_once "src/admin/modelo/ficha/tipofichabd.php";
require_once "src/utils/enviarcorreo.php";

class CorreoCTR extends CTR implements DCTR {

  function __construct() {
    parent::__construct('admin');
  }

  function inicio($mensaje = null) {
    $permisos = PersonaFichaBD::getParaInicio();
    require cargarVistaAdmin('personaficha/index.php');
  }

  function enviados($idPermiso = 0) {
    if ($idPermiso != 0) {
      $personaFichas = PersonaFichaBD::getPorPermiso($idPermiso);
      require cargarVistaAdmin('personaficha/enviados.php');
    } else {
      $this->inicio('No especificaron un permiso del cual ver las fichas enviadas.');
    }
  }

  function nuevo() {
    $permisos = PermisoIngresoBD::getAll();
    require cargarVistaAdmin('personaficha/guardar.php');
  }

  function masivo() {
    $periodos = PeriodoBD::getParaCombo();
    require 'src/admin/vista/correo/masivo.php';
  }

  function nomatriculados() {
    $periodos = PeriodoBD::getParaCombo();
    require 'src/admin/vista/correo/nomatriculados.php';
  }

  function eliminar(){
    PersonaFichaBD::eliminar(isset($_GET['id']) ? $_GET['id'] : 0);
  }

}
