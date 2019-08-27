<?php
require_once 'src/modelo/periodo/periodobd.php';

class PeriodoAPI {

  function todos() {
    $res = PeriodoBD::cargarTodos();
    JSON::muestraJSON($res);
  }

  function buscar($aguja){
    $res = null;
    if(ctype_digit($aguja)){
      $res = PeriodoBD::buscar($aguja);
    }else{
      $res = PeriodoBD::buscarPeriodo($aguja);
    }
    JSON::muestraJSON($res);
  }

  function carrera($id_carrera) {
    $res = PeriodoBD::buscarPorCarrera($id_carrera);
    JSON::muestraJSON($res);
  }

}
 ?>
