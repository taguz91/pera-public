<?php

class TipoFichaMD {

  public $id;
  public $tipo;

  public static function getFromRow($r){
    $tf = new TipoFichaMD();
    $tf->id = isset($r['id_tipo_ficha']) ? $r['id_tipo_ficha'] : null;

    $tf->tipo = isset($r['tipo_ficha']) ? $r['tipo_ficha'] : null;
    return $tf;
  }

}

 ?>
