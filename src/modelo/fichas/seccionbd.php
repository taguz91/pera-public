<?php
require_once 'src/modelo/fichas/seccion.php';
require_once 'src/modelo/fichas/preguntabd.php';

abstract class SeccionBD {

  static function getPorIdTipoFicha($idFicha){
    $ct = getCon();

    $sql = '';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $secciones = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $s = new SeccionMD();

          $s->preguntas = PreguntaBD::getPorIdSeccion(1);

          array_push($secciones, $s);
        }
        return $secciones;
      } else {
        echo "No pudimos consultar las secciones de la ficha.";
        return [];
      }
    }
  }

}

 ?>
