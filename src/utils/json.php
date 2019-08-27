<?php

abstract class JSON {

  static function muestraJSON($items) {
    if($items != null){
      self::imprimeJson(json_encode([
        'statuscode' => 200,
        'items' => $items
      ]));
    }else{
      self::error('No encontramos lo que buscaba.');
    }
  }

  static function error($mensaje) {
    self::imprimeJson(json_encode([
      'statuscode' => 404,
      'mensaje' => $mensaje
    ]));
  }

  static function confirmacion($mensaje) {
    self::imprimeJson(json_encode([
      'statuscode' => 200,
      'mensaje' => $mensaje
    ]));
  }

  public static function muestraIMG($img){
    header('Content-type: image/png');
    echo base64_decode($img);
  }

  private static function imprimeJson($json) {
    header("Content-Type: application/json");
    echo $json;
  }
}

?>
