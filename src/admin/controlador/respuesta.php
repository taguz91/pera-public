<?php
require_once 'src/admin/modelo/ficha/permisoingresobd.php';

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
    $res = json_decode(file_get_contents( constant('URL') . 'api/v1/respuesta/reporte?id_permiso=' . $idPermiso ), true);
    if($res['statuscode'] == 200){
      $reportes = $res['items'];
      $reportes = $reportes[0];

      include cargarVistaAdmin('respuesta/reporte.php');
    }else{
      echo "No obtuvimos resultados";
    }
  }

}

 ?>
