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
      $enviado = EnviarCorreo::enviar($correo, $pass, $mensaje);

      if(is_bool($enviado)){
        $pf = [
          'id_permiso_ingreso_ficha' => $idPermiso,
          'id_persona' => $idPersona,
          'clave' => $pass
        ];

        $res = PersonaFichaBD::guardarPersonaFicha($pf);
        if(is_bool($res)){
          JSON::confirmacion('Guardamos correctamente su contraseña es: ' . $pass);
        } else {
          JSON::error('No pudimos guardarlo ' . $res);
        }
      } else {
        JSON::error('No se envio el correo. ' . $enviado);
      }
    } else {
      JSON::error('No tenemos todos los datos necesarios.');
    }
  }

  function editar(){
    $id = isset($_POST['idperficha']) ? $_POST['idperficha'] : 0;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    if ($id != 0
    && $correo != ''
    ) {
      $pass = getRandomPass();
      $enviado = EnviarCorreo::enviar($correo, $pass, $mensaje);
      if(is_bool($enviado)){
        $res = PersonaFichaBD::editarPersonaFicha($id, $pass);
        if(is_bool($res)){
          JSON::confirmacion('Guardamos correctamente su contraseña es: ' . $pass);
        } else {
          JSON::error('No guardamos el correo:  ' . $res);
        }
      } else {
        JSON::error('No enviamos el correo: ' . $enviado);
      }
    } else {
      JSON::error('No tenemos toda la informacion necesaria.');
    }
  }

  function masivo(){
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
    $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : '';
    $correousar = isset($_POST['correousar']) ? $_POST['correousar'] : '';
    $passwordusar = isset($_POST['passwordusar']) ? $_POST['passwordusar'] : '';
    $correoenviar = isset($_POST['correoenviar']) ? $_POST['correoenviar'] : '';
    $archivo = isset($_FILES['adjunto']) ? $_FILES['adjunto'] : null;

    if (
      $mensaje != ''
      && $asunto != ''
      && $correousar != ''
      && $passwordusar != ''
      && $correoenviar != ''
    ) {
      if($archivo != null && $archivo['name'] != '') {
        $res = EnviarCorreo::enviarConConArchivo(
          $correousar,
          $passwordusar,
          $correoenviar,
          $asunto,
          $mensaje,
          $archivo
        );
        if (is_bool($res)) {
          JSON::confirmacion('Enviamos correctamente con Archivo');
        } else {
          JSON::error('No enviamos el correo:  ' . $res);
        }
      } else {
        $res = EnviarCorreo::enviarConCorreo(
          $correousar,
          $passwordusar,
          $correoenviar,
          $asunto,
          $mensaje
        );
        if (is_bool($res)) {
          JSON::confirmacion('Enviamos correctamente.');
        } else {
          JSON::error('No guardamos el correo:  ' . $res);
        }
      }
    } else {
      JSON::error('No podemos enviar los correos no tenemos todo los datos requeridos.');
    }
  }


}

 ?>
