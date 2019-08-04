<?php
require_once 'src/modelo/fichas/ficha.php';
require_once 'src/modelo/fichas/seccionbd.php';

abstract class FichaBD {

  static function getPorIdPersonaFicha($idPersonaFicha){
    $ct = getCon();

    $sql = '';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $ficha = new FichaMD();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){

          $ficha->secciones = SeccionBD::getPorIdTipoFicha(1);
        }
        return $ficha;
      } else {
        echo "No pudimos consultar fichas";
        return null;
      }
    }
  }

}

 ?>
