<?php
require_once 'src/modelo/fichas/seccion.php';

class PreguntaFichaMD {

  public $id;
  public $pregunta;
  public $ayuda;
  public $preguntaTipo;
  public $respuestaTipo;
  //Foraneas
  public $idSeccionFicha;
  //Objetos
  public $seccionFicha;
  //Arrays
  public $respuestas;

  static function getFromRow($r){
    $pf = new PreguntaFichaMD();
    $pf->id = isset($r['id_pregunta_ficha']) ? $r['id_pregunta_ficha'] : null;
    $pf->pregunta = isset($r['pregunta_ficha']) ? $r['pregunta_ficha'] : null;
    $pf->ayuda = isset($r['pregunta_ficha_ayuda']) ? $r['pregunta_ficha_ayuda'] : null;
    $pf->preguntaTipo = isset($r['pregunta_ficha_tipo']) ? $r['pregunta_ficha_tipo'] : null;
    $pf->respuestaTipo = isset($r['pregunta_ficha_respuesta_tipo']) ? $r['pregunta_ficha_respuesta_tipo'] : null;

    if(isset($r['id_seccion_ficha'])){
      $pf->idSeccionFicha = $r['id_seccion_ficha'];
      $pf->seccionFicha = SeccionFichaMD::getFromRow($r);
    }

    return $pf;
  }

}

 ?>
