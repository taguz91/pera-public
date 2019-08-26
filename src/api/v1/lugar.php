<?php
require_once 'src/modelo/lugar/lugarbd.php';

class LugarAPI {

  function paises(){
    $items = LugarBD::getAllPaises();
    JSON::muestraJSON($items);
  }

  function referencia($idLugar = 0){
    if($idLugar != 0){
      $items = LugarBD::getAllPorReferencia($idLugar);
      JSON::muestraJSON($items);
    }else{
      JSON::error('Debe enviar un id  de un lugar para poder consultar.');
    }
  }

}

 ?>
