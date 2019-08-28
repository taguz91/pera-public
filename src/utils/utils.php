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

  function getOneFromSQL($sql, $params){
    $ct = getCon();
    if($ct != null){
      $sen = $ct->prepare($sql);
      $sen->execute($params);
      $res = null;
      while($r = $sen->fetch(PDO::FETCH_ASSOC)){
        $res = $r;
      }
      return $res;
    }
  }

  function getArrayFromSQL($sql, $params){
    $res = [];
    $ct = getCon();
    if($ct != null){
      try {
        $sen = $ct->prepare($sql);
        $sen->execute($params);
        while($r = $sen->fetch(PDO::FETCH_ASSOC)){
          array_push($res, $r);
        }
      } catch (\PDOException $e) {
        return ['error' => $e->getMessage()];
      }
    }
    return $res;
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


  function buscarPersona($aguja){
    return "
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_identificacion,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_segundo_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%' OR
    TRANSLATE(persona_primer_nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ||
    TRANSLATE(persona_primer_apellido,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ILIKE '%$aguja%'
    ";
  }

 ?>
