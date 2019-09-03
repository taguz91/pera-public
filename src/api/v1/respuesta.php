<?php
require_once 'src/modelo/respuesta/resfs.php';

class RespuestaAPI {

  function todos(){

  }

  /**
  * Si no se indica un parametro se cargan todos pro defecto
  */
  function fs($ver = 'todos'){
    switch ($ver) {
      case 'todos':
        $res = ResFSBD::getAll();
        JSON::muestraJSON($res);
        break;
      default:
        JSON::error('El parametro envio no se encontro');
        break;
    }

  }

}

 ?>
