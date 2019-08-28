<?php

abstract class JSON {

  static function muestraJSON($items) {
    if($items != null){
      if(isset($items['error'])){
        self::error($items['error']);
      }else{
        self::imprimeJson(json_encode([
          'statuscode' => 200,
          'items' => $items
        ]));
      }
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

  public static function muestraPDF($pdf){
    header("Content-type: application/pdf");
    echo base64_decode($pdf);
  }

  private static function imprimeJson($json) {
    header("Content-Type: application/json");
    echo $json;
  }
}

?>
