<?php
include_once 'src/modelo/carrera/carrerabd.php';

class CarreraAPI extends Api {

  function todos() {
    $res = CarreraBD::cargarTodos();
    JSON::muestraJSON($res);
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = CarreraBD::buscar($aguja);
    }else{
      $res = CarreraBD::buscarCarrera($aguja);
    }
    JSON::muestraJSON($res);
  }

}

?>
