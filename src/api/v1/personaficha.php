<?php
require_once 'src/modelo/persona/personafichabd.php';

class PersonaFichaAPI {

  function login() {
    $pass = $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $idPer = isset($_POST['idper']) ? $_POST['idper'] : 0;
    if($pass != '' && $idPer != 0){
      $res = PersonaFichaBD::getPorLogin(
        $idPer,
        $pass
      );

      if($res != null){
        JSON::confirmacion('Permiso ingreso ficha concedido.');
      } else {
        JSON::error('No tenemos permiso de ingresar esta ficha ' . $idPer);
      }
    }else{
      JSON::error('No debe enviar parametros vacios.');
    }
  }

  function correos($param) {
    if (isset($param[0]) && isset($param[1])) {
      $res = PersonaFichaBD::getIdTipo($param[0]);
      if (isset($res['id_tipo_ficha'])) {
        $items = null;
        switch ($res['id_tipo_ficha']) {
          case 1:
            $items = PersonaFichaBD::getCorreosAlumnos($param[0], $param[1]);
            break;
          case 2:
            $items = PersonaFichaBD::getCorreosDocentes($param[0], $param[1]);
            break;
        }
        JSON::muestraJSON($items);
      } else {
        JSON::error('No sabemos que tipo de ficha es.');
      }
    } else {
      JSON::error('No indico los parametros requeridos. permiso-ciclo');
    }
  }

}

 ?>
