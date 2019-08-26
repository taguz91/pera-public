<?php

  function getCon() {
    try {
      $dir = "pgsql:dbname="
      .constant('DB')
      .";host="
      .constant('HOST')
      .";port="
      .constant('PORT')
      .";";

      $pdo = new PDO(
        $dir,
        constant('USER'),
        constant('PASS'));

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (\Exception $e) {
      echo "Oh no: ".$e->getMessage();
      return null;
    }
  }

  function getRes($sql){
    $ct = getCon();
    if($ct != null){
      $res = $ct->query($sql);
      return $res;
    }else {
      return null;
    }
  }

  function getResArray($sql){
    $ct = getCon();
    if($ct != null){
      $res = $ct->query($sql);
      $array = [];
      while($r = $res->fetch(PDO::FETCH_ASSOC)){
        array_push($array, $r);
      }
      return $array;
    }else{
      return [];
    }
  }

  function executeSQL($sql, $params){
    $ct = getCon();
    if($ct != null){
      try {
        $sen= $ct->prepare($sql);
        return $sen->execute($params);
      } catch (\Exception $e) {
        return false;
      }
    }else{
      return false;
    }
  }

  function cargarVista($file){
    $dirVista = 'src/vista/';
    $file = $dirVista.$file;
    if(file_exists($file)){
      return $file;
    }else {
      return 'src/vista/static/errores/404php';
    }
  }

  //Para llenar los combos
  function llenarCmb($cmb) {
    $opts = '<option value="">Seleccione</option>';
    foreach ($cmb as $c) {
      $opts .= '<option value="' . $c . '">' . $c . '</option>';
    }
    return $opts;
  }

 ?>
