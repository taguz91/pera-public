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
    $personaFichas = PersonaFichaBD::getAll();
    require cargarVistaAdmin('personaficha/index.php');
  }

  function nuevo() {
    $permisos = PermisoIngresoBD::getAll();
    require cargarVistaAdmin('personaficha/guardar.php');
  }

  function solo() {
    if(isset($_POST['guardar'])){
      $idPersona = $_POST['idpersona'];
      $idPermiso = $_POST['permiso'];
      $correo = $_POST['correo'];
      $mensaje = $_POST['mensaje'];
      $pass = getRandomPass();
      if(EnviarCorreo::enviar($correo, $pass, $mensaje)){
        $pf = [
          'id_permiso_ingreso_ficha' => $idPermiso,
          'id_persona' => $idPersona,
          'clave' => $pass
        ];

        $res = PersonaFichaBD::guardarPersonaFicha($pf);
        if($res){
          $this->inicio('Enviamos correctamente el correo.');
        }
      }
    }
  }

  function reenviar(){
    if(isset($_GET['id'])){
      require cargarVistaAdmin('personaficha/reenviar.php');
    }
  }

  function enviar() {
    if(isset($_GET['idpersona'])){
      $permisos = PermisoIngresoBD::getForPersona($_GET['idpersona']);
      require cargarVistaAdmin('personaficha/enviaruno.php');
    }
  }

  private function generarContrasena($num){
    $pass = array();
    for ($i = 0; $i < $num; $i++) {
      array_push($pass, getRandomPass());
    }
    return $pass;
  }

  function eliminar(){
    PersonaFichaBD::eliminar(isset($_GET['id']) ? $_GET['id'] : 0);
  }

}
