<?php
require_once "src/admin/modelo/ficha/personafichabd.php";
require_once "src/utils/enviarcorreo.php";

class CorreoAPI {

  function uno() {

    $idPersona = isset($_POST['idpersona']) ? $_POST['idpersona'] : 0;
    $idPermiso = isset($_POST['permiso']) ? $_POST['permiso'] : 0;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    if ( $idPersona != 0
      && $idPermiso != 0
      && $correo != ''
    ) {
      $pass = getRandomPass();

      if(EnviarCorreo::enviar($correo, $pass, $mensaje)){
        $pf = [
          'id_permiso_ingreso_ficha' => $idPermiso,
          'id_persona' => $idPersona,
          'clave' => $pass
        ];

        $res = PersonaFichaBD::guardarPersonaFicha($pf);
        if(is_bool($res)){
          JSON::confirmacion('Guardamos correctamente su pass es: ' + $pass);
        } else {
          JSON::error('No pudimos guardarlo ' . $res);
        }
      } else {
        JSON::error('No se envio el correo.');
      }
    } else {
      JSON::error('No tenemos todos los datos necesarios.');
    }

  }
}

 ?>
