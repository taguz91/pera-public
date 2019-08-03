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
      Errores::errorConectarBD($e->getMessage());
      //echo "Oh no: ".$e->getMessage();
      return null;
    }
  }

  function cargarVista($file){
    $dirVista = 'src/vista/';
    $file = $dirVista.$file;
    if(file_exists($file)){
      return $file;
    }else {
      echo "No encontramos la vista requerida parase que se elimino";
    }
  }

 ?>
