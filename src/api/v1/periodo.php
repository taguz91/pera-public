<?php
require_once 'src/modelo/periodo/periodobd.php';

class PeriodoAPI {

  function ciclos($idPermiso = 0) {
    if ($idPermiso != 0) {
      $items = PeriodoBD::getCiclosByPermiso($idPermiso);
      JSON::muestraJSON($items);
    } else {
      JSON::error('Debe especificarnos el id del permiso a consultar.');
    }
  }

  function cmbGuardar($idTipoFicha = 0) {
    if ($idTipoFicha != 0) {
      $items = PeriodoBD::getParaCmbGuardar($idTipoFicha);
      JSON::muestraJSON($items);
    } else {
      JSON::error('Debe especificarnos el id del tipo de ficha.');
    }
  }

}
