<?php
require_once 'src/admin/modelo/ficha/permisoingresobd.php';
require_once 'src/modelo/respuesta/resfs.php';

class RespuestaCTR extends CTR implements DCTR {

  function __construct() {
      parent::__construct('admin');
  }

  function inicio($mensaje = null) {
    $res = PermisoIngresoBD::getParaReporte();
    require cargarVistaAdmin('respuesta/index.php');
  }

  function reporte() {
    $idPermiso = isset($_GET['idPermiso']) ? $_GET['idPermiso'] : 0;
    $res = ResFSBD::getAll($idPermiso);

    if(isset($res)){
      $reportes = json_decode($res['reportes'], true)[0];

      include cargarVistaAdmin('respuesta/reporte.php');
    }else{
      echo "No obtuvimos resultados";
      echo $url;
    }
  }

}

 ?>
