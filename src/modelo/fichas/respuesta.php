<?php
require_once 'src/modelo/fichas/pregunta.php';

class RespuestaFichaMD {

  public $id;
  public $respuesta;
  //Foraneas
  public $idPregunta;
  //Objeto
  public $pregunta;

  static function getFromRow($r){
    $rt = new RespuestaFichaMD();
    $rt->id = isset($r['id_respuesta_ficha']) ? $r['id_respuesta_ficha'] : null;
    $rt->respuesta = isset($r['respuesta_ficha']) ? $r['respuesta_ficha'] : null;

    if(isset($r['id_pregunta_ficha'])){
      $rt->idPregunta = $r['id_pregunta_ficha'];
      $rt->pregunta = PreguntaFichaMD::getFromRow($r);
    }

    return $rt;
  }

}

 ?>
