<?php

require_once 'src/admin/modelo/ficha/permisoingresobd.php';

class PermisoAPI {

  function alumno($idPersona = 0) {
    if ($idPersona != 0) {
      $items = PermisoIngresoBD::getForPersona($idPersona);
      JSON::muestraJSON($items);
    } else {
      JSON::error('Debe indicar el id de  la persona.');
    }
  }

}

 ?>
