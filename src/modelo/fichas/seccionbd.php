<?php
require_once 'src/modelo/fichas/seccion.php';
require_once 'src/modelo/fichas/preguntabd.php';

abstract class SeccionBD {

  static function getPorIdTipoFicha($idFicha){
    $ct = getCon();

    $sql = '
    SELECT
    sf.id_seccion_ficha,
    seccion_ficha_nombre
    FROM
    public."SeccionesFicha" sf
    WHERE
    sf.id_tipo_ficha = '.$idFicha.';
    ';

    if ($ct != null) {
      $res = $ct->query($sql);
      if ($res != null) {
        $secciones = array();
        while($r = $res->fetch(PDO::FETCH_ASSOC)){
          $s = SeccionFichaMD::getFromRow($r);

          $s->preguntas = PreguntaBD::getPorIdSeccion($s->id);

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
