<?php

abstract class JSON {

  static function muestraJSON($items) {
    if($items != null){
      self::imprimeJson(json_encode([
        'statuscode' => 200,
        'items' => $items
      ]));
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

  private static function imprimeJson($json) {
    header("Content-Type: application/json");
    echo $json;
  }
}

?>
