<?php
require_once 'src/modelo/fichas/tipo.php';

class SeccionFichaMD {

  public $id;
  public $nombre;
  //Foraneas
  public $idTipoFicha;
  //Objetos
  public $tipoFicha;
  //Array
  public $preguntas;

  static function getFromRow($r){
    $s = new SeccionFichaMD();
    $s->id = isset($r['id_seccion_ficha']) ? $r['id_seccion_ficha'] : null;
    $s->nombre = isset($r['seccion_ficha_nombre']) ? $r['seccion_ficha_nombre'] : null;

    if(isset($r['id_tipo_ficha'])){
      $s->idTipoFicha = $r['id_tipo_ficha'];
      $s->tipoFicha = TipoFichaMD::getFromRow($r);
    }

    return $s;
  }

}

 ?>
