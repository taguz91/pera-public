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

  function masivo() {
    $permisos = PermisoIngresoBD::getAll();
    require cargarVistaAdmin('personaficha/guardar.php');
  }


  function guardar() {
    if (isset($_POST['guardar'])) {

      if (
        isset($_POST['permiso']) &&
        isset($_POST['ciclo']) &&
        isset($_POST['correo'])
      ) {
        $pf = [];
        $pf['id_permiso_ingreso_ficha'] = $_POST['permiso'];
        $numCiclo = $_POST['ciclo'];
        $tipoFicha = PermisoIngresoBD::getPorId($pf['id_permiso_ingreso_ficha']);

          if ($tipoFicha['id_tipo_ficha'] == 1) {

            $correosEst = PersonaFichaBD::getCorreosEst($numCiclo, $pf->idPermisoIngFicha);
            if (empty($correosEst)) {
              $this->inicio('Estos ciclos ya se guardaron como fichas');
            } else {
              $this->enviarCorreos($correosEst, $_POST['correo']);
              if($val){
                $this->inicio('Enviamos los correos');
              }
            }

          } else if ($tipoFicha['id_tipo_ficha'] == 2) {
            $correosDoc = PersonaFichaBD::getCorreosDoc($numCiclo, $pf['id_permiso_ingreso_ficha']);

            if (empty($correosDoc)) {
              $this->inicio('Estos ciclos ya se guardaron como fichas');
            } else {
              $numPassDoc = sizeof($correosDoc);
              $passDoc = self::generarContrasena($numPassDoc);

              for ($i = 0; $i < $numPassDoc; $i++) {
                if (EnviarCorreo::enviar($correosDoc->correo, $passDoc, $this->mensaje)) {

                  $pf['id_persona'] = $correosDoc[$i]['id_persona'];
                  $pf['clave'] = $passDoc[$i];
                  $res = PersonaFichaBD::guardarPersonaFicha($pf);
                  if ($res) {
                    $this->inicio('Se envío correctamente los correos a ' . count($correosDoc) . ' estudiantes');
                  } else {
                    $this->inicio('No se puedo guardar correctamente');
                  }
                } else {
                  $this->inicio('No se pudo enviar corectamente todos los correos, se enviaron a' . count($correosEst) . ' estudiantes');
                }
              }
            }
          }
      } else {
        $this->inicio('No tenemos todos los datos necesarios.');
      }
    } else {
      $this->inicio('No indico que guardaremos!.');
    }
  }

  function editar(){
    if(isset($_POST['guardar'])){
      $correo = $_POST['correo'];
      $id = $_POST['idperficha'];
      $mensaje = $_POST['mensaje'];
      $pass = getRandomPass();

      if(EnviarCorreo::enviar($correo, $pass, $mensaje)){
        $res = PersonaFichaBD::editarPersonaFicha($id, $pass);
        if($res){
          $this->inicio('Se reenvio el correo correctamente.');
        }
      }
    }
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

  private function enviarCorreos($correos, $mensaje){
    $numPass = sizeof($correos);
    $pass = self::generarContrasena($numPass);
    $count = 0;
    for ($i = 0; $i < $numPass; $i++) {
      if (EnviarCorreo::enviar($correos[$i], $pass[$i], $mensaje)) {
        set_time_limit(300);
        $pf = [
          'id_persona' => $correos[$i]['id_persona'],
          'clave' => $pass[$i]
        ];

        $res = PersonaFichaBD::guardarPersonaFicha($pf);
        if ($res) {
          $count++;
        }
      }
    }
    return $count;
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

  function enviarCorreoIndividual($idPersona, $correo, $mensajePersonalizado){
    if (
      isset($_POST['permiso']) &&
      isset($_POST['correo'])
    ) {
      $passDoc = self::generarContrasena(1);
      $personaFicha = [
        'id_permiso_ingreso_ficha' => $_POST['permiso'],
        'id_persona' => $idPersona
      ];

      if (EnviarCorreo::enviar($correo, $passDoc[0], $mensajePersonalizado)) {
        $personaFicha['clave'] = $passDoc[0];

        $res = PersonaFichaBD::guardarPersonaFicha($personaFicha);

        $mensaje = $res ? 'Guardamos correctamente.' : 'No pudimos guardarlo.';
        $this->inicio($mensaje);
      } else {
        $this->inicio('No se pudo enviar corectamente el correo');
      }
    } else {
      $this->inicio('No tenemos todos los datos para guardar.');
    }

  }

}
