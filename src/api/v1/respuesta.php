<?php
require_once 'src/modelo/respuesta/resfs.php';
require_once 'src/modelo/persona/personafichabd.php';

class RespuestaAPI {

  function todos(){

  }

  /**
  * Si no se indica un parametro se cargan todos pro defecto
  */
  function fs($ver = 'todos'){
    switch ($ver) {
      case 'todos':
        $res = PersonaFichaBD::getFinalizados();
        JSON::muestraJSON($res);
        break;
      default:
        JSON::error('El parametro envio no se encontro');
        break;
    }
  }

  function reporte($tipo = 'todos') {
    switch ($tipo) {
      case 'todos':
        $res = ResFSBD::getAll();
        $personas = json_decode($res['reportes'], true);
        JSON::muestraJSON($personas);
        break;
      default:
        JSON::error('Debe indicarnos un parametro valido');
        break;
    }
  }

}

 ?>
