<?php
require_once 'src/modelo/periodo/periodobd.php';

class PeriodoAPI {

  function ciclos($idPeriodo = 0) {
    if ($idPeriodo != 0) {
      $items = PeriodoBD::getCiclos($idPeriodo);
      JSON::muestraJSON($items);
    } else {
      JSON::error('Debe especificarnos el id del periodo a consultar.');
    }
  }

}
